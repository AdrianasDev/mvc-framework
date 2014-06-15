<?php

class BaseController
{
    protected $model = array();
    protected $action;
    protected $params = array();
    protected $template;
    
    public function __construct()
    {
    }
    
    public function addModel($model)
    {
        $this->model[$model] = null;
    }
    
    public function setAction($action)
    {
        $this->action = $action;
    }
    
    public function getAction()
    {
        return $this->action;
    }
    
    public function setParams($params)
    {
        foreach ($params as $key => $value) {
            $this->params[] = $value;
        }
    }
    
    public function getParams()
    {
        return $this->params;
    }
    
    public function getTemplate()
    {
        $dir = strtolower(strstr($this->controller, 'Controller', true));
        $file = TEMPLATE_PATH . DS . $dir . DS . $this->action . '.tpl';
        return file_get_contents($file);
    }
}
