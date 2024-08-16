path: /etc/systemd/system


Create Public-Private Key: 
1. ssh-keygen -t rsa -b 4096 -C "devesh.kumar@digiswitch.in"
2. ssh-copy-id -i ~/.ssh/ngdrs-dc.pub root@ngdrs-ag
#transfer public-key
#make hostentries

3. ssh -i ~/.ssh/ngdrs-dc root@ngdrs-ag
#try to login via private-key

sudo dnf install https://dl.fedoraproject.org/pub/epel/epel-release-latest-8.noarch.rpm
sudo dnf install rsync inotify-tools -y

sudo vi /etc/systemd/system/sync_ngdrs_dr_rto.service
#transfer this file to target

sudo systemctl enable sync_ngdrs_dr_rto.service
#enable on reboot

sudo systemctl start sync_ngdrs_dr_rto.service
#start the service
