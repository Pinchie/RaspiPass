<?php
// Read Smarty config and initialise a new instance w/caching
require('setup.php'); // Load Smarty configuration
require('scripts/errordirect.php'); // Load errordirect() function
$smarty = new Smarty_Main();
$smarty->setCaching(false);

$smarty->assign('title','MAC Address List');

//Pull MAC address list
	if (file_exists('/raspipass/mac_addresses.txt')) {
			$smarty->clearAssign('maclist');
	        $maclist=fopen("/raspipass/mac_addresses.txt","r");
	        while (!feof($maclist)) {
	                $macline = trim(preg_replace('/\s+/', ' ', fgets($maclist)));
					if (strpos($macline,',') !== false) {
						$smarty->append('maclist',$macline);
					}
	        }
	        fclose($maclist);
		}
	else {
               $errorlog=fopen("/var/raspipass/web-error.log","w");
               fwrite($errorlog, "/raspipass/mac_addresses.txt is not present, or inaccessible");
               fclose($errorlog);
               header('Location: error.php');
        }

// Load dat template
$smarty->display('maclist.tpl');
?>
