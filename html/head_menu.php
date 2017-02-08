<?php
// Read Smarty config and initialise a new instance w/caching
require('setup.php'); // Load Smarty configuration
require('scripts/errordirect.php'); // Load errordirect() function
$smarty = new Smarty_Main();
$smarty->setCaching(true);

$smarty->assign('title','Header menu');

// Read version from file, if it exists
if (file_exists('/raspipass/version')) {
		$version=file("/raspipass/version",FILE_IGNORE_NEW_LINES);
                $smarty->assign('version',$version[0],true);
        }
        else {
                $smarty->assign('version','0',true);
        }

// Check for new version/update availability
	if (file_exists('/var/raspipass/rpi-latestversion')) {
		$latestversion=file("/var/raspipass/rpi-latestversion");
		$newversionavailable=version_compare($version[0],$latestversion[0],'<');
	}
	else {
		$newversionavailable=0;
	}
	$smarty->assign('newversionavailable',$newversionavailable,true);
	
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
$smarty->display('head_menu.tpl');
?>
