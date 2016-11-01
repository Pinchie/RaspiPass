#!/bin/bash

# Clear system logs to clear disk space

echo Clearing logs
echo dmesg...
dmesg -C
echo Apache2...
echo "" > /var/log/apache2/error.log
echo "" > /var/log/apache2/access.log
echo "" > /var/log/apache2/other_vhosts_access.log
rm /var/log/apache2/*.log.* 2> /dev/null
echo hostapd...
echo "" > /raspipass/log/hostapd
echo Done.

