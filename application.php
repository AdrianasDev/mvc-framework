<?php

class Application
{
    protected $router;
    protected $route;
    protected $dispatcher;
    protected $controller;
    protected $data;
    protected $template;
    
    public function setRouter($router)
    {
        $this->router = $router;
    }
    
    public function run()
    {
        $this->route = $this->router->match();
        
        if (!$this->route) {
            throw new Exception('The requested URL did not match a configured route!');
        }
        else {
            $this->dispatcher = new Dispatcher($this->route);
            $this->data = $this->dispatcher->getData();
            $this->template = $this->dispatcher->getTemplate();
        }
        
    }
}