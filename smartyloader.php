<?php

include 'libs/smarty/Smarty.class.php';

class CMS_Smarty extends Smarty
{
    public function __construct()
    {
        parent::__construct();
        
        $this->setTemplateDir(dirname(__FILE__) . '/system/views/smarty/templates/');
        $this->setCompileDir(dirname(__FILE__) . '/system/views/smarty/templates_c/');
        $this->setConfigDir(dirname(__FILE__) . '/system/views/smarty/configs/');
        $this->setCacheDir(dirname(__FILE__) . '/system/views/smarty/cache/');
        
        $this->caching = Smarty::CACHING_LIFETIME_CURRENT;
        $this->assign('app_name', 'CMSproject');
    }
}