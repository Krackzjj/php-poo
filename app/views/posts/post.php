<?php

/** @var App\Entity\Post $post */
/** @var App\Entity\User $user */

?>

<h1><?= $title ?></h1>
<p><?= $post->getContent() ?></p>
<em><?= var_dump($post) ?></em>