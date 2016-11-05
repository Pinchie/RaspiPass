#!/bin/bash

# Copy files from git directory to system directories and set 
# permissions 

echo "This will copy all files from the /git working directories to the RaspiPass system directories."
echo "Proceeding will cause all matching files in the RaspiPass system directories to be overwritten."
echo "Non-matching files in the RaspiPass system directories will be deleted!"
read -p "Are you sure you want to proceed? [Y/N] " -r -n 1
if [ $REPLY =~ ^[Yy]$ ] || [ $1 = "auto" ]
then
        echo
	
	# /raspipass
	echo Copying /git/raspipass...
	rsync -vryW --exclude /raspipass/log/update.log --del --force /git/raspipass /
	echo Setting permissions...
	sudo chown -R raspi:raspi /raspipass
	sudo chmod 664 /raspipass/config.ini
	sudo chmod 664 /raspipass/hostapd.conf
	sudo chmod 664 /raspipass/mac_addresses.txt
	sudo chmod 664 /raspipass/mac_restrict.txt
	sudo chmod 664 /raspipass/runchance.txt
	sudo chmod 755 /raspipass/log
	sudo chmod 666 /raspipass/log/hostapd
	sudo chmod 666 /raspipass/version
	echo Done.
	echo
	
	# /raspi_secure
	echo Copying /git/raspi_secure...
	sudo rsync -vryW --del --force /git/raspi_secure /
	echo Setting permissions...
	sudo chown -R root:root /raspi_secure
	sudo chmod 644 /raspi_secure/firewall.rules
	sudo chmod 744 /raspi_secure/iptables.sh
	sudo chmod 744 /raspi_secure/raspipass
	sudo chmod 744 /raspi_secure/clear_logs.sh
	echo Done.
	echo
	
	# /var/www/html
	echo Copying /git/html...
	sudo rsync -vryW --del --force /git/html /var/www/
	echo Setting permissions...
	sudo chown -R www-data:www-data /var/www/html
	sudo chmod -R 755 /var/www/html
	echo Done.
else
	echo
	echo Exiting...
fi
