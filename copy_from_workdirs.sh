#/bin/bash
cp -rv /raspipass .
cp -rv /raspi_secure .
cp -rv /var/www/html .
chown -R raspi:raspi raspipass/ raspi_secure/ html/
chmod -R 777 raspipass/
chmod -R 777 raspi_secure/
chmod -R 777 html/
