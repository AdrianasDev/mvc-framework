<?php

require 'config.php';

include 'debug.php';

$router = new AltoRouter($routes, DS . APP_ROOT_BASE);
$match = $router->match();

if (!$match) {
    throw new Exception('The requested URL did not match a configured route!');
}
else {
    $dispatcher = new Dispatcher($match);
    $data = $dispatcher->run();    
}

debug($match);
debug($dispatcher);
debug($data);

