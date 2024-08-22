#!/bin/bash

LOG_FILE="/var/log/mplds-vg_rto.log"
SERVICE_NAME="DT.service"
START_DELAY=60  # Delay after reboot before starting the script

# Function to get current timestamp
get_timestamp() {
    date '+%Y-%m-%d %H:%M:%S'
}

# Function to log events
log_event() {
    local event="$1"
    local timestamp=$(get_timestamp)
    echo "$timestamp - $event" >> "$LOG_FILE"
}

# Function to safely check the service status
safe_check_service_status() {
    systemctl is-active --quiet "$SERVICE_NAME"
    return $?
}

# Capture service stop at shutdown
capture_shutdown() {
    log_event "DT service stopped (shutdown)."
}

# Monitor service stop
monitor_service_stop() {
    if ! safe_check_service_status; then
        log_event "DT service stopped."
    fi
}

# Monitor service start
monitor_service_start() {
    if safe_check_service_status; then
        log_event "DT service started."
        calculate_rto
    fi
}

# Calculate RTO
calculate_rto() {
    stop_time=$(grep "DT service stopped" "$LOG_FILE" | tail -n 1 | cut -d' ' -f1-2)
    start_time=$(grep "DT service started" "$LOG_FILE" | tail -n 1 | cut -d' ' -f1-2)
    if [ -n "$stop_time" ] && [ -n "$start_time" ]; then
        rto=$(( $(date -d "$start_time" +%s) - $(date -d "$stop_time" +%s) ))
        log_event "RTO calculated for mplds-vg: $rto seconds."
    else
        log_event "No RTO calculation for mplds-vg: stop_time or start_time is missing."
    fi
}

# Ensure system is fully up
log_event "Script started with safety delay."
sleep $START_DELAY

# Log system reboot
log_event "System reboot detected."

# Check if the service started after reboot
monitor_service_start

# Track previous status
previous_status="active"
while true; do
    current_status=$(systemctl is-active "$SERVICE_NAME")
    if [ "$current_status" != "$previous_status" ]; then
        if [ "$current_status" = "active" ]; then
            monitor_service_start
        else
            monitor_service_stop
        fi
        previous_status="$current_status"
    fi
    sleep 10
done
