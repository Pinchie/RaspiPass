#/bin/bash
sudo cp -rv /raspipass ../
sudo cp -rv /raspi_secure ../
sudo cp -rv /var/www/html ../
sudo chown -R raspi:raspi ../raspipass/ ../raspi_secure/ ../html/
sudo chmod -R 777 ../raspipass/
sudo chmod -R 777 ../raspi_secure/
sudo chmod -R 777 ../html/
