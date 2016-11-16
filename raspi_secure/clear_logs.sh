#!/bin/bash

# Clear system logs to clear disk space

echo Clearing logs
echo dmesg...
dmesg -C
echo syslog...
echo "" > /var/log/syslog
echo Kernel log...
echo "" > /var/log/kern.log
echo "Old logs (logrotated)..."
rm /var/log/*.{1..9}* 2> /dev/null
echo Apache2...
rm /var/log/apache2/*.log
echo "" > /var/log/apache2/error.log
echo "" > /var/log/apache2/access.log
echo "" > /var/log/apache2/other_vhosts_access.log
echo hostapd...
echo "" > /run/log/hostapd
echo Done.

