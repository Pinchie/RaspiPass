<?php
// Read Smarty config and initialise a new instance w/caching
require('setup.php'); // Load Smarty configuration
require('scripts/errordirect.php'); // Load errordirect() function
$smarty = new Smarty_Main();
$smarty->setCaching(true);

// Retrieve version
if (file_exists('/raspipass/version')) {
		$version=file("/raspipass/version",FILE_IGNORE_NEW_LINES);
                $smarty->assign('version',$version[0],true);
        }
        else {
                $smarty->assign('version','0',true);
        }

// Load dat template
$smarty->display('home.tpl');
?>
