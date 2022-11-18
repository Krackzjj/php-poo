<?php

/** @var App\Entity\Post $post */


?>

<h1><?= $title ?></h1>
<p><?php echo $post['post']->getContent(); ?></p>
<p><?php echo $post['username']; ?></p>

<p>Commentaires :</p>