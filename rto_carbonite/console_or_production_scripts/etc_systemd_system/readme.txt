Steps: 

1. echo "/usr/local/bin/monitor_dt_service.sh capture_shutdown" > /usr/local/bin/capture_shutdown.sh
2. chmod +x /usr/local/bin/capture_shutdown.sh
3. systemctl enable capture_shutdown.service

path: /etc/systemd/system
