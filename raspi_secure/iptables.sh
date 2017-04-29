#!/bin/bash
# Used for testing new iptables rules before exporting with iptables-save.
#
# To restore previously-saved rules, you are better off running:
# sudo iptables-restore < /raspi_secure/firewall.rules

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
        echo "iptables.sh -- Set iptables rules"
        echo
        echo "*** NOTE: To be run with sudo, or as root"
	echo "If trying to restore rules, consider using \"sudo iptables-restore < /raspi_secure/firewall.rules\" instead"
        echo
        echo "USAGE: iptables.sh [OPTIONS]"
        echo
        echo "Option		Meaning"
        echo "-h		This help text"
        exit 0
fi

# Allow loopback
iptables -I INPUT 1 -i lo -j ACCEPT

# Allow DHCP
iptables -A INPUT -p udp --sport 67:68 --dport 67:68 -j ACCEPT
iptables -A OUTPUT -p udp --sport 67:68 --dport 67:68 -j ACCEPT 
iptables -A FORWARD -p udp --sport 67:68 --dport 67:68 -j ACCEPT 

# Allow SSH
iptables -A INPUT -m physdev --physdev-in eth0 -p tcp --dport 22 -j ACCEPT
iptables -A OUTPUT -p tcp --sport 22 -j ACCEPT

# Allow HTTP 
iptables -A INPUT -m physdev --physdev-in eth0 -p tcp --dport 80 -j ACCEPT
iptables -A OUTPUT -s 0/0 -p tcp --sport 80 -j ACCEPT

# Allow the device to make outgoing HTTP requests
iptables -A OUTPUT -s 0/0 -p tcp --dport 80 -j ACCEPT

# Allow DNS
iptables -A INPUT -p udp --sport 53 -j ACCEPT
iptables -A INPUT -p udp --dport 53 -j ACCEPT
iptables -A OUTPUT -p udp --dport 53 -j ACCEPT
iptables -A OUTPUT -p tcp --dport 53 -j ACCEPT
iptables -A FORWARD -p udp --dport 53 -j ACCEPT
iptables -A FORWARD -p tcp --dport 53 -j ACCEPT

# Allow NTP since the raspi has no RTC
iptables -A INPUT -m physdev --physdev-in eth0 -p tcp --dport 123 -j ACCEPT
iptables -A OUTPUT -p tcp --sport 123 -j ACCEPT
iptables -A INPUT -m physdev --physdev-in eth0 -p udp --dport 123 -j ACCEPT
iptables -A OUTPUT -p udp --sport 123 -j ACCEPT

# Allow CIFS both ways
iptables -A OUTPUT -p tcp --sport 137:139 -j ACCEPT
iptables -A OUTPUT -p udp --sport 137:139 -j ACCEPT
iptables -A OUTPUT -p tcp --sport 445 -j ACCEPT
iptables -A OUTPUT -p tcp --dport 137:139 -j ACCEPT
iptables -A OUTPUT -p udp --dport 137:139 -j ACCEPT
iptables -A OUTPUT -p tcp --dport 445 -j ACCEPT
iptables -A INPUT -m physdev --physdev-in eth0 -p tcp --dport 137:139 -j ACCEPT
iptables -A INPUT -m physdev --physdev-in eth0 -p udp --dport 137:139 -j ACCEPT
iptables -A INPUT -m physdev --physdev-in eth0 -p tcp --dport 445 -j ACCEPT
iptables -A INPUT -m physdev --physdev-in eth0 -p tcp --sport 137:139 -j ACCEPT
iptables -A INPUT -m physdev --physdev-in eth0 -p udp --sport 137:139 -j ACCEPT
iptables -A INPUT -m physdev --physdev-in eth0 -p tcp --sport 445 -j ACCEPT

# Allow established TCP/UDP connections back in
iptables -A INPUT  -p tcp -m state --state RELATED,ESTABLISHED -j ACCEPT
iptables -A INPUT  -p udp -m state --state RELATED,ESTABLISHED -j ACCEPT
iptables -A OUTPUT  -p tcp -m state --state RELATED,ESTABLISHED -j ACCEPT
iptables -A OUTPUT  -p udp -m state --state RELATED,ESTABLISHED -j ACCEPT
iptables -A FORWARD  -p tcp -m state --state RELATED,ESTABLISHED -j ACCEPT
iptables -A FORWARD  -p udp -m state --state RELATED,ESTABLISHED -j ACCEPT

# Allow connection to GitHub servers
iptables -A INPUT -m physdev --physdev-in eth0 -s 192.30.252.0/22 -j ACCEPT
iptables -A OUTPUT -d 192.30.252.0/22 -j ACCEPT

# Allow connection to GitHub raw server (for version check)
iptables -A INPUT -m physdev --physdev-in eth0 -s 151.101.100.133 -j ACCEPT
iptables -A INPUT -m physdev --physdev-in eth0 -s 151.101.28.133 -j ACCEPT
iptables -A OUTPUT -d 151.101.100.133 -j ACCEPT
iptables -A OUTPUT -d 151.101.28.133 -j ACCEPT

# Allow multicasts
iptables -A INPUT -d 224.0.0.0/8 -j ACCEPT
iptables -A INPUT -s 224.0.0.0/8 -j ACCEPT
iptables -A OUTPUT -d 224.0.0.0/8 -j ACCEPT
iptables -A OUTPUT -s 224.0.0.0/8 -j ACCEPT
iptables -A FORWARD -d 224.0.0.0/8 -j ACCEPT
iptables -A FORWARD -s 224.0.0.0/8 -j ACCEPT

# Streetpass relay whitelist	
iptables -A INPUT -s 52.43.174.40 -j ACCEPT
iptables -A INPUT -s 104.70.153.178 -j ACCEPT
iptables -A INPUT -s 104.74.48.110 -j ACCEPT
iptables -A INPUT -s 23.7.18.146 -j ACCEPT
iptables -A INPUT -s 23.7.24.35 -j ACCEPT
iptables -A INPUT -s 52.11.210.152 -j ACCEPT
iptables -A INPUT -s 52.25.179.65 -j ACCEPT
iptables -A INPUT -s 52.89.56.205 -j ACCEPT
iptables -A INPUT -s 54.148.137.96 -j ACCEPT
iptables -A INPUT -s 54.218.98.74 -j ACCEPT
iptables -A INPUT -s 54.218.99.79 -j ACCEPT
iptables -A INPUT -s 54.244.22.201 -j ACCEPT
iptables -A INPUT -s 69.25.139.140 -j ACCEPT
iptables -A INPUT -s 192.195.204.216 -j ACCEPT
iptables -A INPUT -s 52.10.249.207 -j ACCEPT
iptables -A OUTPUT -d 52.43.174.40 -j ACCEPT
iptables -A OUTPUT -d 104.70.153.178 -j ACCEPT
iptables -A OUTPUT -d 104.74.48.110 -j ACCEPT
iptables -A OUTPUT -d 23.7.18.146 -j ACCEPT
iptables -A OUTPUT -d 23.7.24.35 -j ACCEPT
iptables -A OUTPUT -d 52.11.210.152 -j ACCEPT
iptables -A OUTPUT -d 52.25.179.65 -j ACCEPT
iptables -A OUTPUT -d 52.89.56.205 -j ACCEPT
iptables -A OUTPUT -d 54.148.137.96 -j ACCEPT
iptables -A OUTPUT -d 54.218.98.74 -j ACCEPT
iptables -A OUTPUT -d 54.218.99.79 -j ACCEPT
iptables -A OUTPUT -d 54.244.22.201 -j ACCEPT
iptables -A OUTPUT -d 69.25.139.140 -j ACCEPT
iptables -A OUTPUT -d 192.195.204.216 -j ACCEPT
iptables -A OUTPUT -d 52.10.249.207 -j ACCEPT
iptables -A FORWARD -d 52.43.174.40 -j ACCEPT
iptables -A FORWARD -d 104.70.153.178 -j ACCEPT
iptables -A FORWARD -d 104.74.48.110 -j ACCEPT
iptables -A FORWARD -d 23.7.18.146 -j ACCEPT
iptables -A FORWARD -d 23.7.24.35 -j ACCEPT
iptables -A FORWARD -d 52.11.210.152 -j ACCEPT
iptables -A FORWARD -d 52.25.179.65 -j ACCEPT
iptables -A FORWARD -d 52.89.56.205 -j ACCEPT
iptables -A FORWARD -d 54.148.137.96 -j ACCEPT
iptables -A FORWARD -d 54.218.98.74 -j ACCEPT
iptables -A FORWARD -d 54.218.99.79 -j ACCEPT
iptables -A FORWARD -d 54.244.22.201 -j ACCEPT
iptables -A FORWARD -d 69.25.139.140 -j ACCEPT
iptables -A FORWARD -d 192.195.204.216 -j ACCEPT
iptables -A FORWARD -d 52.10.249.207 -j ACCEPT
iptables -A FORWARD -s 52.43.174.40 -j ACCEPT
iptables -A FORWARD -s 104.70.153.178 -j ACCEPT
iptables -A FORWARD -s 104.74.48.110 -j ACCEPT
iptables -A FORWARD -s 23.7.18.146 -j ACCEPT
iptables -A FORWARD -s 23.7.24.35 -j ACCEPT
iptables -A FORWARD -s 52.11.210.152 -j ACCEPT
iptables -A FORWARD -s 52.25.179.65 -j ACCEPT
iptables -A FORWARD -s 52.89.56.205 -j ACCEPT
iptables -A FORWARD -s 54.148.137.96 -j ACCEPT
iptables -A FORWARD -s 54.218.98.74 -j ACCEPT
iptables -A FORWARD -s 54.218.99.79 -j ACCEPT
iptables -A FORWARD -s 54.244.22.201 -j ACCEPT
iptables -A FORWARD -s 69.25.139.140 -j ACCEPT
iptables -A FORWARD -s 192.195.204.216 -j ACCEPT
iptables -A FORWARD -s 52.10.249.207 -j ACCEPT

# Set up log for non-matching patckets
iptables -N LOGGING
iptables -N WLAN_LOGGING

# Redirect remaining I/O packets to logging chain
iptables -A INPUT -m physdev --physdev-in wlan0 -j WLAN_LOGGING
iptables -A INPUT -j LOGGING
iptables -A OUTPUT -j LOGGING
iptables -A FORWARD -j LOGGING

# Set logging options - non-WLAN disabled due to oversized logs. Uncomment to log dropped packet info.
#iptables -A LOGGING -m limit --limit 20/min -j LOG --log-prefix "Dropped packet: " --log-level 4
iptables -A WLAN_LOGGING -m limit --limit 10/min -j LOG --log-prefix "Dropped incoming wlan packet: " --log-level 4

# Drop 'em
iptables -A LOGGING -j DROP
iptables -A WLAN_LOGGING -j DROP
