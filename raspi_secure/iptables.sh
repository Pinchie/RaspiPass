#/bin/bash
# Used for testing new iptables rules before exporting with iptables-save.
#
# To restore previously-saved rules, you are better off running:
# sudo iptables-restore < /raspi_secure/firewall.rules

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
iptables -A OUTPUT -p tcp --sport 80 -j ACCEPT

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

# Allow multicasts
iptables -A INPUT -s 224.0.0.0 -p tcp -j ACCEPT
iptables -A OUTPUT -d 224.0.0.0 -p tcp -j ACCEPT
iptables -A FORWARD -d 224.0.0.0 -p tcp -j ACCEPT
iptables -A FORWARD -s 224.0.0.0 -p tcp -j ACCEPT

# Streetpass relay whitelist	
iptables -A INPUT -s 103.246.150.249 -j ACCEPT
iptables -A OUTPUT -d 103.246.150.249 -j ACCEPT
iptables -A INPUT -s 111.168.21.83 -j ACCEPT
iptables -A OUTPUT -d 111.168.21.83 -j ACCEPT
iptables -A INPUT -s 192.195.204.139 -j ACCEPT
iptables -A OUTPUT -d 192.195.204.139 -j ACCEPT
iptables -A INPUT -s 202.32.117.142 -j ACCEPT
iptables -A OUTPUT -d 202.32.117.142 -j ACCEPT
iptables -A INPUT -s 202.32.117.143 -j ACCEPT
iptables -A OUTPUT -d 202.32.117.143 -j ACCEPT
iptables -A INPUT -s 202.32.117.172 -j ACCEPT
iptables -A OUTPUT -d 202.32.117.172 -j ACCEPT
iptables -A INPUT -s 23.66.85.79 -j ACCEPT
iptables -A OUTPUT -d 23.66.85.79 -j ACCEPT
iptables -A INPUT -s 23.66.98.90 -j ACCEPT
iptables -A OUTPUT -d 23.66.98.90 -j ACCEPT
iptables -A INPUT -s 54.244.22.201 -j ACCEPT
iptables -A OUTPUT -d 54.244.22.201 -j ACCEPT
iptables -A INPUT -s 69.25.139.140 -j ACCEPT
iptables -A OUTPUT -d 69.25.139.140 -j ACCEPT
iptables -A INPUT -s 69.25.139.140 -j ACCEPT
iptables -A OUTPUT -d 69.25.139.140 -j ACCEPT
iptables -A INPUT -s 69.25.139.162 -j ACCEPT
iptables -A OUTPUT -d 69.25.139.162 -j ACCEPT
iptables -A INPUT -s 69.25.139.164 -j ACCEPT
iptables -A OUTPUT -d 69.25.139.164 -j ACCEPT
iptables -A INPUT -s 69.25.139.169 -j ACCEPT
iptables -A OUTPUT -d 69.25.139.169 -j ACCEPT
iptables -A INPUT -s 52.88.120.190 -j ACCEPT
iptables -A OUTPUT -d 52.88.120.190 -j ACCEPT
iptables -A INPUT -s 52.24.79.99 -j ACCEPT
iptables -A OUTPUT -d 52.24.79.99 -j ACCEPT
iptables -A INPUT -s 23.7.24.35 -j ACCEPT
iptables -A OUTPUT -d 23.7.24.35 -j ACCEPT
iptables -A INPUT -s 54.218.98.74 -j ACCEPT
iptables -A OUTPUT -d 54.218.98.74 -j ACCEPT
iptables -A FORWARD -s 103.246.150.249 -j ACCEPT
iptables -A FORWARD -d 103.246.150.249 -j ACCEPT
iptables -A FORWARD -s 111.168.21.83 -j ACCEPT
iptables -A FORWARD -d 111.168.21.83 -j ACCEPT
iptables -A FORWARD -s 192.195.204.139 -j ACCEPT
iptables -A FORWARD -d 192.195.204.139 -j ACCEPT
iptables -A FORWARD -s 202.32.117.142 -j ACCEPT
iptables -A FORWARD -d 202.32.117.142 -j ACCEPT
iptables -A FORWARD -s 202.32.117.143 -j ACCEPT
iptables -A FORWARD -d 202.32.117.143 -j ACCEPT
iptables -A FORWARD -s 202.32.117.172 -j ACCEPT
iptables -A FORWARD -d 202.32.117.172 -j ACCEPT
iptables -A FORWARD -s 23.66.85.79 -j ACCEPT
iptables -A FORWARD -d 23.66.85.79 -j ACCEPT
iptables -A FORWARD -s 23.66.98.90 -j ACCEPT
iptables -A FORWARD -d 23.66.98.90 -j ACCEPT
iptables -A FORWARD -s 54.244.22.201 -j ACCEPT
iptables -A FORWARD -d 54.244.22.201 -j ACCEPT
iptables -A FORWARD -s 69.25.139.140 -j ACCEPT
iptables -A FORWARD -d 69.25.139.140 -j ACCEPT
iptables -A FORWARD -s 69.25.139.140 -j ACCEPT
iptables -A FORWARD -d 69.25.139.140 -j ACCEPT
iptables -A FORWARD -s 69.25.139.162 -j ACCEPT
iptables -A FORWARD -d 69.25.139.162 -j ACCEPT
iptables -A FORWARD -s 69.25.139.164 -j ACCEPT
iptables -A FORWARD -d 69.25.139.164 -j ACCEPT
iptables -A FORWARD -s 69.25.139.169 -j ACCEPT
iptables -A FORWARD -d 69.25.139.169 -j ACCEPT
iptables -A FORWARD -s 52.88.120.190 -j ACCEPT
iptables -A FORWARD -d 52.88.120.190 -j ACCEPT
iptables -A FORWARD -s 52.24.79.99 -j ACCEPT
iptables -A FORWARD -d 52.24.79.99 -j ACCEPT
iptables -A FORWARD -s 23.7.24.35 -j ACCEPT
iptables -A FORWARD -d 23.7.24.35 -j ACCEPT
iptables -A FORWARD -s 54.218.98.74 -j ACCEPT
iptables -A FORWARD -d 54.218.98.74 -j ACCEPT
iptables -A INPUT -s 52.27.236.3 -j ACCEPT
iptables -A OUTPUT -d 52.27.236.3 -j ACCEPT
iptables -A FORWARD -s 52.27.236.3 -j ACCEPT
iptables -A FORWARD -d 52.27.236.3 -j ACCEPT

# Set up log for non-matching patckets
iptables -N LOGGING
iptables -N WLAN_LOGGING

# Redirect remaining I/O packets to logging chain
iptables -A INPUT -m physdev --physdev-in wlan0 -j WLAN_LOGGING
iptables -A INPUT -j LOGGING
iptables -A OUTPUT -j LOGGING
iptables -A FORWARD -j LOGGING

# Set logging options - non-WLAN disabled due to oversize logs. Uncomment to log dropped packet info.
#iptables -A LOGGING -m limit --limit 20/min -j LOG --log-prefix "Dropped packet: " --log-level 4
iptables -A WLAN_LOGGING -m limit --limit 10/min -j LOG --log-prefix "Dropped incoming packet on wlan0: " --log-level 4

# Drop 'em
iptables -A LOGGING -j DROP
iptables -A WLAN_LOGGING -j DROP
