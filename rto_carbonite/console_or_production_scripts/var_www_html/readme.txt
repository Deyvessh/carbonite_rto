1. sudo dnf install httpd
2. sudo systemctl start httpd
3. sudo systemctl enable httpd

4. sudo dnf install php php-common php-cli
5. sudo systemctl restart httpd 

6. sudo nano /var/www/html/monitor_log.php
# copy contents of monitor_log.php in this file

7. sudo chown apache:apache /var/log/ngdrs-ag_rto.log
# change ownership

8. sudo chmod 644 /var/log/dt_service_monitor.log
# file permission

Open below URL as it automatically redirects to monitor_log.php

http://20.192.19.125 -> http://20.192.19.125/monitor_log.php
