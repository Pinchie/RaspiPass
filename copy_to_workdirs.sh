#/bin/bash

# Copy files from git directory to working directories and set 
# permissions 

# /raspipass
cp -rfv raspipass/ /
chown -R raspi:raspi /raspipass
chmod 664 /raspipass/config.ini
chmod 664 /raspipass/hostapd.conf
chmod 664 /raspipass/mac_addresses.txt
chmod 664 /raspipass/mac_restrict.txt
chmod 664 /raspipass/runchance.txt
chmod 755 /raspipass/log
chmod 664 /raspipass/log/hostapd

# /raspi_secure
cp -rfv raspi_secure/ /
chown -R root:root /raspi_secure
chmod 700 /raspi_secure/clear_logs.sh
chmod 644 /raspi_secure/firewall.rules
chmod 644 /raspi_secure/iptables.txt
chmod 755 /raspi_secure/raspipass

# /var/www/html
cp -rfv html/ /var/www/
chown -R www-data:www-data /var/www/html
chmod -R 755 /var/www/html

