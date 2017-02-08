<?php
// Read Smarty config and initialise a new instance w/caching
require('setup.php'); // Load Smarty configuration
require('scripts/errordirect.php'); // Load error handling
$smarty = new Smarty_Main();
$smarty->setCaching(false);

$smarty->assign('title','Administrative Tasks');

// Check for pending reboot - smarty will assign rebootmsg if reboot notification
// file exists
	$smarty->clearAssign('rebootmsg');
	if (file_exists('/var/raspipass/reboot')) {
		$rebootmsg=file("/var/raspipass/reboot");
	}
	else {
		$rebootmsg=0;
	}
	$smarty->assign('rebootmsg',$rebootmsg[0],true);
	
// Load dat template
$smarty->display('admintasks.tpl');
?>
