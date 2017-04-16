<?php
// Call external locale array
require('scripts/locales.php');

$locale=$cleanlocales[$_POST['Locale']];
echo "Setting locale to $locale" . "<br>";
echo "<br>";
$absolutelocale="/usr/share/zoneinfo/" . $locale;

// Copy $absolutelocale to /etc/localtime
// Put contents of $locale in /etc/timezone
// Reconfigure with new timezone data
exec('sudo sh -c "cp "' . $absolutelocale . '" /etc/localtime"');
exec('sudo sh -c "echo "' . $locale . '" > /etc/timezone"');
exec('sudo sh -c "dpkg-reconfigure --frontend=noninteractive tzdata > /dev/null 2>&1"');
echo "Set to $locale - reloading configuration page";
header('Location: index.php');
?>
