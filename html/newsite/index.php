<?php
// Read Smarty config and initialise a new instance w/caching
require('setup.php');
$smarty = new Smarty_Main();
$smarty->setCaching(true);

$smarty->assign('title','RaspiPass Configuration Page');

// Set up redirection on error
	function errordirect($errormsg) {
	        $errorlog=fopen("/var/raspipass/web-error.log","w");
	        fwrite($errorlog, $errormsg);
	        fclose($errorlog);
		header('Location: error.php');
	}

// Read config.ini and assign to smarty variables
	if (file_exists('/raspipass/config.ini')) {
	        $config_array=parse_ini_file("/raspipass/config.ini");
		$smarty->assign('wifi_country',$config_array[wifi_country]);
		$smarty->assign('wifi_channel',$config_array[wifi_channel]);
		$smarty->assign('mac_restriction',$config_array[mac_restriction]);
		$smarty->assign('runchance',$config_array[runchance]);
		$smarty->assign('runinterval',$config_array[runinterval]);
	}
	else {
                errordirect("/raspipass/config.ini is not present, or inaccessible");
        }

// Read version from file, if it exists
if (file_exists('/raspipass/version')) {
		$version=file("/raspipass/version",FILE_IGNORE_NEW_LINES);
                $smarty->assign('version',$version);
        }
        else {
                $smarty->assign('version','0');
        }

// Load dat template
$smarty->display('index.tpl');
?>
