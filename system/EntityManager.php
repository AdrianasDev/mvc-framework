<?php

class EntityManager
{
    protected static $classregistry = array();
    protected $database;
    
    public function __construct()
    {
        $this->database = new Database();
    }
    
    public static function register($object)
    {
        self::$classregistry[] = $object;
    }
    
    public static function exec_db_function($function, $params)
    {
        
    }
    
}