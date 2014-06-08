<?php

use Base\PostQuery;
require '/system/controllers/controller.php';

class PostController extends Controller
{
    private $model;
    private $classname  = 'Post';
    private $query      = 'PostQuery';
    
    public function __construct()
    {
        $this->model = new $this->classname;
    }
    
    function getData()
    {
        $post = PostQuery::create()->find();
        echo "<pre>";
        print_r($post);
        echo "</pre>";
    }
}
