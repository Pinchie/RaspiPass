<?php
// Read Smarty config and initialise a new instance w/caching
require('errordirect.php'); // Add errordirect() function
require('setup.php');
$smarty = new Smarty_Main();
$smarty->setCaching(true);

$smarty->assign('title','RaspiPass Configuration Page');

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
