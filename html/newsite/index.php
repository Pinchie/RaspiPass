<?php
require('setup.php');
$smarty = new Smarty_Main();
$smarty->setCaching(true);
$smarty->assign('title','RaspiPass Configuration Page');
if (file_exists('/raspipass/version')) {
		$version=file("/raspipass/version");
                $smarty->assign('version',$version[0]);
        }
        else {
                $smarty->assign('version','0');
        }
$smarty->display('index.tpl');
?>
