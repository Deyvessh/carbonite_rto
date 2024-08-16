# carbonite_rto
Script is made to calculate RTO (Recovery Point Objective) after Failover/Switchover

There are various functions involved 
So, I have tried to minimize any efforts and added readme.txt file in each and every compartment. 

== Tree Stucture as follows == 

rto_carbonite/
|-- console_or_production_scripts
|   |-- etc_systemd_system
|   |   |-- capture_shutdown.service
|   |   |-- log_dt_shutdown.service
|   |   `-- readme.txt
|   |-- usr_local_bin
|   |   |-- capture_shutdown.sh
|   |   |-- current_production_hostname.txt
|   |   |-- log_dt_shutdown.sh
|   |   |-- monitor_dt_service.sh
|   |   `-- readme.txt
|   `-- var_www_html
|       |-- css
|       |   `-- custom.css
|       |-- fetch_log.php
|       |-- images
|       |   `-- digiswitch.png
|       |-- index.html
|       |-- monitor_log.php
|       `-- readme.txt
`-- target_scripts
    |-- etc_systemd_system
    |   |-- readme.txt
    |   `-- sync_ngdrs_dc_rto.service
    `-- usr_local_bin
        |-- current_target_hostname.txt
        |-- readme.txt
        `-- sync_ngdrs_dc_rto.sh

**If tree structure is not properly shown - Please see the link here : ![Screenshot 2024-08-16 at 8 03 03 PM](https://github.com/user-attachments/assets/e92f8e82-9795-4b22-9647-37a39e83df62)


-- Devesh Kumar
