#!/bin/bash

# Copy files from git directory to system directories and set 
# permissions 

echo "This will copy all files from the /git working directories to the RaspiPass system directories."
echo "Proceeding will cause all matching files in the RaspiPass system directories to be overwritten."
echo "Non-matching files in the RaspiPass system directories will be deleted!"
if [[ ! "$@" =~ "-a" ]]
then
	read -p "Are you sure you want to proceed? [Y/N] " -r -n 1
fi
if [[ "$REPLY" =~ ^[Yy]$ ]] || [[ "$@" =~ "-a" ]]
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
				echo Recursively applying $owner,$perm to $file
				chown -R $owner $file
				chmod -R $perm $file
			else
				echo Applying $owner,$perm to $file
				chown $owner $file
				chmod $perm $file
			fi
		else
	
		# Then files, as long as they aren't in /git/scripts
			if [ -f "$file" ] && [[ ! "$file" =~ "/git/scripts" ]]
			then
				echo Applying $owner,$perm to $file
				chown $owner $file
				chmod $perm $file
			else
		# Ignore the following: the first line, any files in /git/scripts, and any blank lines. Return error
		# for remaining files.
				if [ "$file" != "Location" ] && [ -n "$file" ] && [[ ! "$file" =~ "/git/scripts" ]]
				then
					echo ERROR: $file does not exist!
				else
					echo Skipping $file
				fi
			fi
		fi
	done < /git/scripts/filepermissions


else
	echo
	echo Exiting...
fi
