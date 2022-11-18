<?php

foreach ($posts as $post) :
?>

    <p style="border: 1px solid black;padding:1rem;"><?= $post->getContent() ?></p>

<?php endforeach ?>

<a href="/sign">Sign</a>
<a href="/login">login</a>