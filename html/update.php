<?php
        echo '<html><head><title>Update in progress......</title></head><body>Updating RaspiPass...</body></html>';
	exec('sudo date > /run/log/raspipass-update.log');
        exec('sudo git -C /git pull origin master >> /run/log/raspipass-update.log && 
		sudo /git/scripts/copy_to_sysdirs.sh auto >> /run/log/raspipass-update.log && 
		sudo chmod -Rv 777 /git/raspipass /git/raspi_secure /git/html /git/scripts >> /run/log/raspipass-update.log');
?>

