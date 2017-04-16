<?php

// Get Locale region list by searching for directories under /usr/share/zoneinfo
$localeregions=array_filter(glob('/usr/share/zoneinfo/*'), 'is_dir');

// Remove unwanted entries
$localeregions=array_diff($localeregions, array('/usr/share/zoneinfo/right', '/usr/share/zoneinfo/posix', '/usr/share/zoneinfo/SystemV', '/usr/share/zoneinfo/Etc'));

// Get timezone files from each region's directory
foreach($localeregions as $localeregion) {
        $appendlocales=scandir($localeregion);
        $appendlocales=array_diff($appendlocales, array('.', '..'));
  // Append each result to the array using absolute path
        foreach($appendlocales as $appendlocale) {
                $localepath[]=$localeregion . "/" . $appendlocale;
        }
}

// Clean up the leading /usr/share/zoneinfo/ for readability in drop-down
$cleanlocales=str_replace("/usr/share/zoneinfo/","",$localepath);

// Get index in array of current locale
$currentlocale=array_search(trim(file_get_contents('/etc/timezone'),"\n"), $cleanlocales);

// Assign locales to smarty array
if (isset($smarty)) {
$smarty->assign('locales',$cleanlocales);
$smarty->assign('currentlocale',$currentlocale);
}
?>
