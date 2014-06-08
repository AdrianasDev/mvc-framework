<?php

require 'system/models/propel-setup.php';

include 'debug.php';

$data = array
(
    array('Title' => 'My First Post', 'Body' => 'The body for My First Post.'),
    array('Title' => 'Another Post', 'Body' => 'Another Post Body.'),
);

if (isset($_GET['func'])) {
	switch ($_GET['func']) {
		case 'saveData':
            saveData($data);
		break;
		case 'getData':
		    getData();
		break;
	}
}
else {
    die('No GET parameter!');
}

function saveData($data)
{
    foreach ($data as $d) {
        $post = new Post();
        $post->fromArray($d);
        $post->save();
    }
    debug($data);
}

function getData()
{
    $post = PostQuery::create()->find();
    debug($post);
}
