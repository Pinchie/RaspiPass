<?php
	ob_start();
	echo '<html><head><title>Starting access point....</title></head><body>';
	echo 'Starting access point....';
	exec('sudo /raspi_secure/raspipass 100 > /raspipass/log/hostapd');
	echo '</body>';
	echo '</html>';
	ob_flush();
	sleep(2);
	ob_start();
	header('Location: index.php');
?>
