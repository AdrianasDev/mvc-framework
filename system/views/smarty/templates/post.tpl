{* Smarty *}

{foreach $posts as $post}
<h2>{$post->title}</h2>
<div>{$post->body}</div>
{/foreach}
