<?php
        echo '<html><head><title>Update in progress......</title></head><body>Updating RaspiPass...</body></html>';
        exec('sudo git -C /git pull origin master > /raspipass/log/update.log && sudo /git/scripts/copy_to_sysdirs.sh >> /raspipass/log/update.log');
?>

