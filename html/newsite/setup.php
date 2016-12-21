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
   }

}
?>
