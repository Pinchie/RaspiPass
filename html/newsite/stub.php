<?php
// Read Smarty config and initialise a new instance w/caching
require('setup.php');
$smarty = new Smarty_Main();
$smarty->setCaching(true);

// Load dat template
$smarty->display('PUT_TPL_FILE_HERE');
?>
