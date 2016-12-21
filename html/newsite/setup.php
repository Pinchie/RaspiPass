<?php

// load Smarty library
define('SMARTY_DIR', './smarty/libs/');
require_once(SMARTY_DIR . 'Smarty.class.php');

// The setup.php file is a good place to load
// required application library files, and you
// can do that right here. An example:
// require('guestbook/guestbook.lib.php');

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
		$this->assign('errormessage','/raspipass/config.ini is not present, or inaccessible');
        }

   }

}
?>
