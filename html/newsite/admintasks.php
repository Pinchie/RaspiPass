<?php
// Read Smarty config and initialise a new instance w/caching
require('setup.php'); // Load Smarty configuration
require('scripts/errordirect.php'); // Load error handling
$smarty = new Smarty_Main();
$smarty->setCaching(false);

$smarty->assign('title','Administrative Tasks');

// Load dat template
$smarty->display('admintasks.tpl');
?>
