<?php
// Read Smarty config and initialise a new instance w/caching
require('setup.php'); // Load Smarty configuration
require('scripts/errordirect.php'); // Load errordirect() function
$smarty = new Smarty_Main();
$smarty->setCaching(true);


// Load dat template
$smarty->display('home.tpl');
?>
