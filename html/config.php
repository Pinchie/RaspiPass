<?php
// Read Smarty config and initialise a new instance w/caching
require('setup.php'); // Load Smarty configuration
require('scripts/errordirect.php'); // Load errordirect() function
$smarty = new Smarty_Main();
$smarty->setCaching(false);
$smarty->assign('title','Raspipass Config');
// Call external wifi country/channel arrays
require('scripts/wificountries.php');

// Read config array into smarty array without caching
if (file_exists('/raspipass/config.ini')) {
               $config_array=parse_ini_file("/raspipass/config.ini");
               $smarty->assign('config_array',$config_array,true);
       }
       else {
               $errorlog=fopen("/var/raspipass/web-error.log","w");
               fwrite($errorlog, "/raspipass/config.ini is not present, or inaccessible");
               fclose($errorlog);
               header('Location: error.php');
}

// Load dat template
$smarty->display('config.tpl');
?>
