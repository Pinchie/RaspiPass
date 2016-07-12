#/bin/bash

# Copy files from git directory to working directories and set 
# permissions 

# /raspipass
sudo cp -rfv ../raspipass/ /
sudo chown -R raspi:raspi /raspipass
sudo chmod 664 /raspipass/config.ini
sudo chmod 664 /raspipass/hostapd.conf
sudo chmod 664 /raspipass/mac_addresses.txt
sudo chmod 664 /raspipass/mac_restrict.txt
sudo chmod 664 /raspipass/runchance.txt
sudo chmod 755 /raspipass/log
sudo chmod 664 /raspipass/log/hostapd

# /raspi_secure
sudo cp -rfv ../raspi_secure/ /
sudo chown -R root:root /raspi_secure
sudo chmod 700 /raspi_secure/clear_logs.sh
sudo chmod 644 /raspi_secure/firewall.rules
sudo chmod 644 /raspi_secure/iptables.txt
sudo chmod 755 /raspi_secure/raspipass

# /var/www/html
sudo cp -rfv ../html/ /var/www/
sudo chown -R www-data:www-data /var/www/html
sudo chmod -R 755 /var/www/html

