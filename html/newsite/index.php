<?php

require('setup.php');
$smarty = new Smarty_Main();
$smarty->assign('name','Mark');
$smarty->display('index.tpl');
?>
