<?php
// Call external locale array
require('scripts/locales.php');

$locale=$cleanlocales[$_POST['Locale']];
echo "Setting locale to $locale" . "<br>";
echo "<br>";
$absolutelocale="/usr/share/zoneinfo/" . $locale;
echo "Path to locale is $absolutelocale" . "<br>";
?>
