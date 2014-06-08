<?php

function loadController($class) 
{
    $filename = $class . '.php';
    $classname = strstr($class, 'Controller', true);
	$path = 'system/controllers/' . $classname . '/' . $filename;
	
	if (file_exists($path)) {
	    require_once $path;
	}
	else {
	    throw new Exception('Could not autoload' . $path);
	}
}

spl_autoload_register('loadController');