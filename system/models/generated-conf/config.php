<?php
$serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
$serviceContainer->checkVersion('2.0.0-dev');
$serviceContainer->setAdapterClass('CMSproject', 'mysql');
$manager = new \Propel\Runtime\Connection\ConnectionManagerSingle();
$manager->setConfiguration(array (
  'dsn' => 'mysql:host=localhost;dbname=CMSproject',
  'user' => 'arjan',
  'password' => 'Midas.645',
));
$manager->setName('CMSproject');
$serviceContainer->setConnectionManager('CMSproject', $manager);
$serviceContainer->setDefaultDatasource('CMSproject');
$serviceContainer->setLoggerConfiguration('defaultLogger', array (
  'type' => 'stream',
  'path' => '/var/log/propel.log',
  'level' => '300',
));