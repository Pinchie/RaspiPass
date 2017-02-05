<?php
// Read Smarty config and initialise a new instance
require('scripts/errordirect.php'); // Add errordirect() function
require('setup.php');
$smarty = new Smarty_Main();
$smarty->setCaching(false);

$smarty->assign('title','RaspiPass Configuration Page');

// Load dat template
$smarty->display('index.tpl');
?>
