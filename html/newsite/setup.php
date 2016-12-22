<?php

// load Smarty library
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
// Read config.ini and assign to smarty variables
        if (file_exists('/raspipass/config.ini')) {
                $config_array=parse_ini_file("/raspipass/config.ini");
		$this->assign('config_array',$config_array);
        }
        else {
		$errorlog=fopen("/var/raspipass/web-error.log","w");
	        fwrite($errorlog, "/raspipass/config.ini is not present, or inaccessible");
	        fclose($errorlog);
	        header('Location: error.php');
        }

   }

}
?>
