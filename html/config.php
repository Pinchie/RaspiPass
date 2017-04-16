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

// Calculate average runs per hour
$runsperhour=round(($config_array["runchance"]/100)/($config_array["runinterval"]/60),2);
$smarty->assign('runsperhour',$runsperhour);

// Get Locale region list
$localeregions=array_filter(glob('/usr/share/zoneinfo/*'), 'is_dir');
  // Remove unwanted entries
$localeregions=array_diff($localeregions, array('/usr/share/zoneinfo/right', '/usr/share/zoneinfo/posix'));
  // Get files from each region directory
foreach($localeregions as $localeregion) {
	$appendlocales=scandir($localeregion);
	$appendlocales=array_diff($appendlocales, array('.', '..'));
  // Save each entry as an absolute path
	foreach($appendlocales as $appendlocale) {
		$localepath[]=$localeregion . "/" . $appendlocale;
	}
}
  // Clean up the leading /usr/share/zoneinfo/ for readability in drop-down
$cleanlocales=str_replace("/usr/share/zoneinfo/","",$localepath);

  // Assign resuls to smarty array
$smarty->assign('locales',$cleanlocales);

// Load dat template
$smarty->display('config.tpl');
?>
