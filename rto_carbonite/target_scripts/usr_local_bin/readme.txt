These file belongs to be written under target or production

path: /usr/local/bin


sudo vi /usr/local/bin/sync_ngdrs_dr_rto.sh
sudo chmod +x /usr/local/bin/sync_ngdrs_dr_rto.sh


#CronJob has to be created to restart monitor_dt_service.sh at reboot

crontab -e #make the entry under crontab
@reboot /usr/local/bin/monitor_dt_service.sh

crontab -l #to show the crontab
@reboot /usr/local/bin/monitor_dt_service.sh
