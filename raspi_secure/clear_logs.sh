#!/bin/bash

# Clear system logs to clear disk space

echo Clearing logs: dmesg, syslog, kernel, apache2, hostapd, rotated logs...
dmesg -C
echo "" > /var/log/syslog
echo "" > /var/log/kern.log
rm /var/log/*.{1..9}* 2> /dev/null
rm /var/log/apache2/*.log
echo "" > /var/log/apache2/error.log
echo "" > /var/log/apache2/access.log
echo "" > /var/log/apache2/other_vhosts_access.log
echo "" > /run/log/hostapd
echo Done.

