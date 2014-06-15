<?php

class BaseModel
{
    public function __construct()
    {
        
    }
    
    public function save($class)
    {
        EntityManager::register($class, $this);
    }
}