<?php

require '/system/controllers/controller.php';

class PostController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    
    function index()
    {
        $posts = PostQuery::create()->find();
        return $posts;
    }
}
