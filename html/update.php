<?php
        echo '<html><head><title>Update in progress......</title></head><body>Updating RaspiPass...';
	exec('sudo sh -c "date > /var/log/raspipass/update.log"');
        exec('sudo sh -c "git -C /git checkout master >> /var/log/raspipass/update.log" && 
		sudo sh -c "git -C /git fetch --all >> /var/log/raspipass/update.log" &&
		sudo sh -c "git -C /git reset --hard origin/master >> /var/log/raspipass/update.log" &&
		sudo sh -c "/git/scripts/copy_to_sysdirs.sh -a -v >> /var/log/raspipass/update.log" && 
		sudo sh -c "/git/scripts/set_interfaces.sh >> /var/log/raspipass/update.log" &&
		sudo sh -c "chmod -Rv 777 /git/raspipass /git/raspi_secure /git/html /git/scripts >> /var/log/raspipass/update.log"');
	echo '<br>Finished!';
	echo '</body></html>';

?>

