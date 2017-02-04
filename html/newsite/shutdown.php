<?php
        echo '<html><head><title>Shutting down...</title></head><body>Shutting down device....</body></html>';
        exec('sudo shutdown -h now');
?>

