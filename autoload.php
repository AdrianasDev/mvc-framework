<?php

function loadController($class) 
{
    if (strpos($class, 'Controller')) {
        $filename = $class . '.php';
        $classname = strstr($class, 'Controller', true);
        $path = 'system/controllers/' . $classname . '/' . $filename;
        
        if (file_exists($path)) {
            require_once $path;
        }
        else {
            throw new Exception('Could not autoload ' . $path);
        }	
    }
}

spl_autoload_register('loadController');

