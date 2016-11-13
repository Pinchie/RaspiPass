<?php
        echo '<html><head><title>Update in progress......</title></head><body>Updating RaspiPass...';
	exec('sudo sh -c "date > /run/log/raspipass-update.log"');
        exec('sudo sh -c "git -C /git pull origin master >> /run/log/raspipass-update.log" && 
		sudo sh -c "/git/scripts/copy_to_sysdirs.sh auto >> /run/log/raspipass-update.log" && 
		sudo sh -c "/git/scripts/set_interfaces.sh >> /run/log/raspipass-update.log" &&
		sudo sh -c "chmod -Rv 777 /git/raspipass /git/raspi_secure /git/html /git/scripts >> /run/log/raspipass-update.log"');
	echo '<br>Finished!';
	echo '</body></html>';

?>

