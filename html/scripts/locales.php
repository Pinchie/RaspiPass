<?php

// Get Locale region list
$localeregions=array_filter(glob('/usr/share/zoneinfo/*'), 'is_dir');
// Remove unwanted entries
$localeregions=array_diff($localeregions, array('/usr/share/zoneinfo/right', '/usr/share/zoneinfo/posix', '/usr/share/zoneinfo/System', '/usr/share/zoneinfo/Etc'));
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

// Assign locales to smarty array
$smarty->assign('locales',$cleanlocales);

?>
