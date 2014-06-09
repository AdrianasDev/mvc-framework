<?php

function loadController($class) 
{
    if (strpos($class, 'Controller')) {
        $filename = $class . '.php';
        $classname = strstr($class, 'Controller', true);
        $path = CONTROLLER_PATH . DS . $classname . '/' . $filename;
        
        if (file_exists($path)) {
            require_once $path;
        }
        else {
            throw new Exception('Could not autoload ' . $path);
        }	
    }
}

spl_autoload_register('loadController');

function loadClasses($class)
{
    $registered_classes = array('Dispatcher');
    $index = array_search($class, $registered_classes);
    if (is_int($index)) {
        $filename = SYSTEM_PATH . DS . $class . '.class.php';
        
        if (file_exists($filename)) {
            require_once $filename;
        }
        else {
            throw new Exception('Could not autoload ' . $filename);
        }
    }
}

spl_autoload_register('loadClasses');
