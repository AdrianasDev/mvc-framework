<?php

require 'system/models/propel-setup.php';
require 'autoload.php';

include 'debug.php';

$postcontroller = new PostController();
$all_posts = $postcontroller->index();

debug($all_posts);