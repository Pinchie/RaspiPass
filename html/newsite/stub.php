<?php
// Read Smarty config and initialise a new instance w/caching
require('setup.php');
$smarty = new Smarty_Main();
$smarty->setCaching(true);

      if (file_exists('/var/raspipass/web-error.log')) {
                $errorlist=fopen("/var/raspipass/web-error.log","r");
                while (!feof($errorlist)) {
                        $errorline = fgets($errorlist);
                        print $errorline;
                }
                fclose($errorlist);
                smarty->assign('errorlist',$errorlist)
        }
        else {
                echo 'DOUBLE-DOWN ERROR: Could not read error from file' . "\n";
        }

// Load dat template
$smarty->display('error.tpl');
?>
