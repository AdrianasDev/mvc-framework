<?php

/**
 * Define constants.
 */
define('DS', DIRECTORY_SEPARATOR);
define('APP_ROOT', dirname(__FILE__));
define('APP_ROOT_BASE', basename(dirname(__FILE__)));
define('LIBS_PATH', APP_ROOT . DS . 'libs');
define('SYSTEM_PATH', APP_ROOT . DS . 'system');
define('CONTROLLER_PATH', SYSTEM_PATH . DS . 'controllers');
define('APP_NAME', 'CMSproject');

/**
 * Database connection configuration
 */
$dbconfig = array(
	'dsn' => 'mysql:host=localhost;dbname=CMSproject',
	'user' => 'arjan',
	'password' => 'Midas.645',
);

/**
 * Router configuration.
 */

require 'libs/AltoRouter/AltoRouter.php';

$routes = array(
	array('GET', '/post', array('PostController', 'index'), 'list_all_posts'),
    array('GET', '/post/[i:id]/view', array('PostController', 'view'), 'view_post'),
);

/**
 * Include autoloaders.
 */
require 'system/models/propel-setup.php';
require 'autoload.php';
