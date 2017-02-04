<?php
	ob_start();
	echo '<html><head><title>Starting access point....</title></head><body>';
	echo 'Starting access point....';
	exec('sudo sh -c "/raspi_secure/raspipass -p 100 > /var/raspipass/hostapd.log"');
	echo '</body>';
	echo '</html>';
	ob_flush();
	sleep(2);
	ob_start();
	header('Location: index.php');
?>
