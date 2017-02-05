<?php
// Configure Smarty environment - not called from external php file to avoid
// circular redirecting
define('SMARTY_DIR', './smarty/libs/');
require_once(SMARTY_DIR . 'Smarty.class.php');

class Smarty_Main extends Smarty {

   function __construct()
   {
        // Class Constructor.
        // These automatically get set with each new instance.
        parent::__construct();
        $this->setTemplateDir('./templates/');
        $this->setCompileDir('./templates_c/');
        $this->setConfigDir('./configs/');
        $this->setCacheDir('./cache/');
        $this->caching = Smarty::CACHING_LIFETIME_CURRENT;
        $this->assign('app_name', 'RaspiPass');
        $this->debugging = true;
    }
}

$smarty = new Smarty_Main();
$smarty->setCaching(false);

      if (file_exists('/var/raspipass/web-error.log')) {
		$smarty->assign('errorlist',file('/var/raspipass/web-error.log',FILE_IGNORE_NEW_LINES,true));
        }
        else {
                $smarty->assign('errorlist','DOUBLE-DOWN ERROR: Could not read original error from file',true);
        }

// Load dat template
$smarty->display('error.tpl');
?>
