<?php
// Read Smarty config and initialise a new instance w/caching
require('setup.php');
$smarty = new Smarty_Main();
$smarty->setCaching(true);

      if (file_exists('/var/raspipass/web-error.log')) {
//		$errorfile = file('/var/raspipass/web-error.log',FILE_IGNORE_NEW_LINES);
		$smarty->assign('errorlist',file('/var/raspipass/web-error.log',FILE_IGNORE_NEW_LINES));
        }
        else {
                $smarty->assign('errorlist','DOUBLE-DOWN ERROR: Could not read error from file');
        }

// Load dat template
$smarty->display('error.tpl');
?>
