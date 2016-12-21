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

// Redirect if $errorline has been carried
$errormessage=$smarty->getTemplateVars('errormessage');
if ($errormessage) {
	errordirect($errormessage);
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
