#!/bin/bash
# Script to clear log files - particularly Apache ones - and set
# certain files to their default configuration.
#
# Designed to be run before distribution
#
# To be run as root

# Call log clearing script
/raspi_secure/clear_logs.sh
echo ""
echo Settings defaults:

# Apply defaults to config.ini
echo config.ini...
echo "; RaspiPass configuration file for web frontend" > /raspipass/config.ini
echo "; Edit this config via the web interface" >> /raspipass/config.ini
echo "[hostapd_config]" >> /raspipass/config.ini
echo "wifi_country=\"US\"" >> /raspipass/config.ini
echo "wifi_channel=\"10\"" >> /raspipass/config.ini
echo "mac_restriction=0" >> /raspipass/config.ini
echo "runchance=\"20\"" >> /raspipass/config.ini
echo "runinterval=\"6\"" >> /raspipass/config.ini

# Apply defaults to runchance.txt
echo runchance.txt...
echo "# RaspiPass probability file" > /raspipass/runchance.txt
echo "# This determines the chance of the access point being" >> /raspipass/runchance.txt
echo "# raisd when the script runs." >> /raspipass/runchance.txt
echo "# This is best edited via the web configuration." >> /raspipass/runchance.txt
echo "probability=20" >> /raspipass/runchance.txt

# Apply default Git config for /git directory
echo git config...
echo "[core]" > /git/.git/config
echo "	repositoryformatversion = 0" >> /git/.git/config
echo "	filemode = true" >> /git/.git/config
echo "	bare = false" >> /git/.git/config
echo "	logallrefupdates = true" >> /git/.git/config
echo "[user]" >> /git/.git/config
echo "	name = " >> /git/.git/config
echo "	email = " >> /git/.git/config
echo "" >> /git/.git/config
echo "[remote \"origin\"]" >> /git/.git/config
echo "	url = https://github.com/Pinchie/RaspiPass" >> /git/.git/config
echo "	fetch = +refs/heads/*:refs/remotes/origin/*" >> /git/.git/config

# Done
echo ""
echo Logs have been cleared and settings reverted to default.
