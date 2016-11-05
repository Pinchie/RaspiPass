#!/bin/bash
# Used to copy files from system directories to git working directories

echo "This will copy all files from the RaspiPass system directories to the /git working directories."
echo "Proceeding will cause all matching files in the /git working directories to be overwritten."
echo "Non-matching files in the /git working directories will be deleted!"
read -p "Are you sure you want to proceed? [Y/N] " -n 1 -r
if [[ $REPLY =~ ^[Yy]$ ]]
then
	echo	
	echo Copying /raspipass...
	sudo rsync --exclude '/raspipass/log/update.log' -ryW --del --force /raspipass /git/
	echo "" > ../raspipass/update.log
	echo Copying /raspi_secure...
	sudo rsync -ryW --del --force /raspi_secure /git/
	echo Copying /var/www/html...
	sudo rsync -ryW --del --force /var/www/html /git/
	echo Setting open permissions...
	sudo chown -R raspi:raspi ../raspipass/ ../raspi_secure/ ../html/
	sudo chmod -R 777 ../raspipass/
	sudo chmod -R 777 ../raspi_secure/
	sudo chmod -R 777 ../html/
	echo Done.
else
	echo
	echo Exiting...
fi
