<?php

class AutoLoader
{
    protected $searchpaths = array(LIBS_PATH, SYSTEM_PATH, CONTROLLER_PATH, MODEL_PATH);
    protected $registered_classes = array(
        'BaseController',
        'BaseModel',
        'Dispatcher',
        'Model' => array(),
        'Controller' => array()
    ); 
    
    public function __construct()
    {
        spl_autoload_register(array($this, 'load'));
    }
    
    public function addClass($class, $type = null)
    {
        if ($type == null) {
            $this->registered_classes[] = $class;
        }
        else {
            $this->registered_classes[$type] = $class;
        }
    }
    
    public function load($class)
    {
        if (file_exists(LIBS_PATH . DS . $class)) {
            require_once LIBS_PATH . DS . $class . DS . $class . '.php';
        }
        elseif (file_exists(SYSTEM_PATH . DS . $class . '.php')) {
            require_once SYSTEM_PATH . DS . $class . '.php';
        }
        elseif (in_array($class, $this->registered_classes)) {
            if (strpos($class, 'Controller')) {
                $dir = strstr($class, 'Controller', true);
                if (file_exists(CONTROLLER_PATH . DS . $dir . DS . $class . '.php')) {
                    require_once CONTROLLER_PATH . DS . $dir . DS . $class . '.php';
                }
            }    
            if (file_exists(MODEL_PATH . DS . $class . DS . $class . '.php')) {
                require_once MODEL_PATH . DS . $class . DS . $class . '.php';
            }
        }
    }
}
