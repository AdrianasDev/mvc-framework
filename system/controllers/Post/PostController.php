<?php

class PostController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
        
    }
    
    public function view($id) 
    {
    	echo $id;
    }
    
    public function create()
    {
        $this->model['Post'] = new Post();
    }
}
