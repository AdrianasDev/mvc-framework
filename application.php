<?php

class Application
{
    protected $autoloader;
    protected $router;
    protected $route;
    protected $dispatcher;
    protected $model;
    protected $entitymanager;
    protected $controller;
    protected $template;
    
    public function setRouter($router)
    {
        $this->router = $router;
    }
    
    public function init()
    {
        $this->route = $this->router->match();
        
        if (!$this->route) {
            throw new Exception('The requested URL did not match a configured route!');
        }
        else {
            $this->autoloader = new AutoLoader();
            $this->dispatcher = new Dispatcher($this->route);
            $this->model = $this->dispatcher->getModel();
            $this->template = $this->dispatcher->getTemplate();
            
            $this->autoloader->addClass($this->dispatcher->getController(), 'Controller');
            $this->autoloader->addClass($this->dispatcher->getModel(), 'Model');
            
            $this->setController();
            
            $this->controller->addModel($this->dispatcher->getModel());
            $this->controller->setAction($this->dispatcher->getAction());
            $this->controller->setParams($this->dispatcher->getParams());
            
            $this->entitymanager = new EntityManager();
        }
    }
    
    private function setController() {
        $cName = $this->dispatcher->getController();
        $this->controller = new $cName;
    }
    
    public function run()
    {
        call_user_func_array(
            array($this->controller, $this->controller->getAction()), 
            $this->controller->getParams());
    }
    
}