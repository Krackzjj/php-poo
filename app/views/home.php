<a href="/sign">Sign</a>
<a href="/login">login</a>
<?php

foreach ($posts as $post) :
?>

    <p style="border: 1px solid black;padding:1rem;"><?= $post->getContent() ?></p>
    <a href="/post/<?php echo $post->getId() ?>">lire</a>

<?php endforeach ?>
<hr>
<a href="/new">Nouveau</a>