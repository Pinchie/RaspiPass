<?php
// Read Smarty config and initialise a new instance w/caching
require('setup.php'); // Load Smarty configuration
require('scripts/errordirect.php'); // Load error handling
$smarty = new Smarty_Main();
$smarty->setCaching(false);

$smarty->assign('title','Log Viewer');

// Read log contents

	$smarty->clearAssign('logcontents');
	if (file_exists('/var/raspipass/hostapd.log')) {
	        $hostapd_log=fopen("/var/raspipass/hostapd.log","r");
	        while (!feof($hostapd_log)) {
	                $hostapd_log_line = trim(preg_replace('/\s+/', ' ', fgets($hostapd_log)));
	                $smarty->append('logcontents',$hostapd_log_line);
	        }
	        fclose($hostapd_log);
	}
	else {
                $smarty->append('logcontents','No /var/raspipass/hostapd.log file present - RaspiPass has probably not run since boot');
        }



// Load dat template
$smarty->display('logviewer.tpl');
?>
