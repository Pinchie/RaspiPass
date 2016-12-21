<?php
// Read Smarty config and initialise a new instance w/caching
require('setup.php');
$smarty = new Smarty_Main();
$smarty->setCaching(true);

$smarty->assign('title','TITLE_GOES_HERE');

// Set up redirection on error
        function errordirect($errormsg) {
                $errorlog=fopen("/var/raspipass/web-error.log","w");
                fwrite($errorlog, $errormsg);
                fclose($errorlog);
                header('Location: error.php');
        }

// Redirect if $errorline has been carried
$errormessage=$smarty->getTemplateVars('errormessage');
if ($errormessage) {
        errordirect($errormessage);
}

//


// Load dat template
$smarty->display('TPL_FILE_HERE');
?>
