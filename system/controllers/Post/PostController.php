<?php

require '/system/controllers/controller.php';

class PostController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
        $posts = PostQuery::create()->find();
        return $posts;
    }
    
    public function view($id) {
    	$post = PostQuery::create()->findById($id);
    	return $post;
    }
}
