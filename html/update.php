<?php
        echo '<html><head><title>Update in progress......</title></head><body>Updating RaspiPass...</body></html>';
	echo('date > /raspipass/log/update.log');
        exec('sudo git -C /git pull origin master >> /raspipass/log/update.log && sudo /git/scripts/copy_to_sysdirs.sh auto >> /raspipass/log/update.log && sudo chmod -Rv 777 /git/raspipass /git/raspi_secure /git/html /git/scripts >> /raspipass/log/update.log');
?>

