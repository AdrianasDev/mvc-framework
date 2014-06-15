<?php

require 'config.php';
require 'application.php';

include 'debug.php';

$router = new AltoRouter($routes, DS . APP_ROOT_BASE);
$application = new Application();
$application->setRouter($router);
$application->init();
$application->run();

debug($application);
