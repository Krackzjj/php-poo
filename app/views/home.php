<?php


/** @var App\Entity\User $post */
/** @var App\Entity\Post[] $post */

foreach ($posts as $post) :

?>
    <p><?= var_dump($post) ?></p>

<?php endforeach ?>

<a href="/sign">Sign</a>
<a href="/login">login</a>