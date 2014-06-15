<?php

class Dispatcher
{
    protected $controller;
    protected $action;
    protected $params = array();
    protected $model;
    protected $template;
    
    public function __construct($match)
    {
    	$this->setController($match['target'][0]);
    	$this->setAction($match['target'][1]);
    	$this->setParams($match['params']);
    	$this->setModel();
    	$this->setTemplate();
    }
    
    public function getController()
    {
        return $this->controller;
    }
    
    public function setController($controller) 
    {
        $this->controller = $controller;
    }
    
    public function getAction()
    {
        return $this->action;
    }
    
    public function setAction($action)
    {
        $this->action = $action;
    }
    
    public function getParams()
    {
        return $this->params;
    }
    
    public function setParams($params)
    {
        $this->params = $params;
    }
    
    public function getModel()
    {
        return $this->model;
    }
    
    public function setModel()
    {
        $this->model = strstr($this->controller, 'Controller', true);
    }
    
    public function getTemplate()
    {
        return $this->template;
    }
    
    public function setTemplate()
    {
        $this->template = $this->action . '.tpl';
    }
}
