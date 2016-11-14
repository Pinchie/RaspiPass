#!/bin/bash

# Copy files from git directory to system directories and set 
# permissions 

echo "This will copy all files from the /git working directories to the RaspiPass system directories."
echo "Proceeding will cause all matching files in the RaspiPass system directories to be overwritten."
echo "Non-matching files in the RaspiPass system directories will be deleted!"
if [ "$1" != "auto" ]
then
	read -p "Are you sure you want to proceed? [Y/N] " -r -n 1
fi
if [[ "$REPLY" =~ ^[Yy]$ ]] || [[ $1 = "auto" ]]
then
        echo
	
	# /raspipass
	echo Copying /git/raspipass...
	rsync -vryW --exclude /raspipass/log/update.log --del --force /git/raspipass /
	echo Done.
	echo
	
	# /raspi_secure
	echo Copying /git/raspi_secure...
	sudo rsync -vryW --del --force /git/raspi_secure /
	echo Done.
	echo
	
	# /var/www/html
	echo Copying /git/html...
	sudo rsync -vryW --del --force /git/html /var/www/
	echo Done.

	echo Setting permissions...
	
	IFS=","
	while read file owner perm recurse
	do
		# Directories first
		if [ -d "$file" ]
		then
			if [ $recurse == "TRUE" ]
			then
				chown -R $owner $file
				chmod -R $perm $file
			else
				chown $owner $file
				chmod $perm $file
			fi
		else
	
		# Then files and bad references
			if [ -f "$file" ]
			then
				chown $owner $file
				chmod $perm $file
			else
		# Ignore first line ($file="Location") and any blank links
				if [ "$file" != "Location" ] && [ -n "$file" ]
				then
					echo ERROR: $file does not exist!
				fi
			fi
		fi
	done < /git/scripts/filepermissions


else
	echo
	echo Exiting...
fi
