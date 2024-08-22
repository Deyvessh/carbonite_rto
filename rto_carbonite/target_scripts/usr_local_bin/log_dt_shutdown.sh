#!/bin/bash

LOG_FILE="/var/log/mplds-vg_rto.log"

# Function to get current timestamp
get_timestamp() {
    date '+%Y-%m-%d %H:%M:%S'
}

# Function to log the service stop time
log_service_stop() {
    local timestamp=$(get_timestamp)
    echo "$timestamp - DT service stopped (shutdown)." >> "$LOG_FILE"
}

# Log the service stop time
log_service_stop
