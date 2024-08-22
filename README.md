# carbonite_rto
Script is made to calculate RTO (Recovery Point Objective) after Failover/Switchover

There are various functions involved 
So, I have tried to minimize any efforts and added readme.txt file in each and every compartment. 

== Tree Stucture as follows == 

.
|-- LICENSE
|-- README.md
`-- rto_carbonite
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
    |       `-- servers.txt
    `-- target_scripts
        |-- etc_systemd_system
        |   |-- capture_shutdown.service
        |   |-- log_dt_shutdown.service
        |   |-- readme.txt
        |   `-- sync_ngdrs_dc_rto.service
        `-- usr_local_bin
            |-- capture_shutdown.sh
            |-- current_target_hostname.txt
            |-- log_dt_shutdown.sh
            |-- monitor_dt_service.sh
            |-- readme.txt
            `-- sync_ngdrs_dc_rto.sh

10 directories, 26 files


**If tree structure is not properly shown - Please see the link here : ![Screenshot 2024-08-22 at 6 16 32 PM](https://github.com/user-attachments/assets/2351dd0d-ded5-41be-adf1-41a1f8e6023d)



-- Devesh Kumar
