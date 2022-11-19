<?php

/** @var App\Entity\Post $post */


?>

<h1><?= $title ?></h1>
<em><b><?php echo $author ?></b></em>
<hr>
<p><?php echo $post->getContent() ?></p>
<hr>
<p>Commentaires :</p>