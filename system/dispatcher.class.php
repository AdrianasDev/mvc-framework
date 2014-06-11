<?php

class Dispatcher
{
    protected $controller;
    protected $action;
    protected $params;
    
    public function __construct($match)
    {
    	$this->setController($match['target'][0]);
    	$this->setAction($match['target'][1]);
    	$this->setParams($match['params']);
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
    
    public function getData()
    {
        foreach($this->params as $key => $value){
            $p[] = $value;
        }
        $p = implode(",", $p);
        $ctrlr = new $this->controller;
        $action = $this->action;
        $result = $ctrlr->$action($p);
        return $result;
    }
    
    public function getTemplate()
    {
        $dir = strtolower(strstr($this->controller, 'Controller', true));
        $file = TEMPLATE_PATH . DS . $dir . DS . $this->action . '.tpl';
        return file_get_contents($file); 
    }
}
