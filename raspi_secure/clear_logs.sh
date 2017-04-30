#!/bin/bash
# Clear system logs to clear disk space

errcho() { echo "$@" 1>&2; }

# Read command-line parameters
while getopts ":h" opt; do
        case "$opt" in
                h)
                        HELP=true
                        ;;
                \?)
                        errcho "Invalid option: -$OPTARG"
                        exit 1
                        ;;
                 :)
                        errcho "Option -$OPTARG requires an argument."
                        exit 1
                        ;;

        esac
done

if [[ $HELP == true ]]
then
        echo "clear_logs.sh -- Clear RaspiPass and system log files"
        echo
        echo "*** NOTE: To be run with sudo, or as root"
        echo
        echo "USAGE: clear_logs.sh [OPTIONS]"
        echo
        echo "Option		Meaning"
        echo "-h		This help text"
        exit 0
fi

echo Clearing logs: dmesg, syslog, kernel, apache2, hostapd, rotated, login history, command history logs...
dmesg -C
echo > /var/log/syslog
echo > /var/log/kern.log
rm /var/log/*.{1..9}* 2> /dev/null
rm /var/log/apache2/*.log
echo > /var/log/apache2/error.log
echo > /var/log/apache2/access.log
echo > /var/log/apache2/other_vhosts_access.log
echo > /var/raspipass/hostapd
echo > /var/log/wtmp
echo > /var/log/btmp
echo > /var/log/lastlog
echo > /home/raspi/.bash_history
echo Done.

