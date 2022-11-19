<div class="container-fluid">
    <header class="container d-flex justify-content-center">
        <h1>Tous les Posts</h1>
    </header>
    <?php
    echo isset($_SESSION['auth']) ? "<a href='/logout' class='btn btn-danger mx-1 mt-1'>Déconnexion</a>" : "<a href='/login' class='btn btn-success mx-1 mt-1'>Connexion</a>";
    echo isset($_SESSION['auth']) ? '' : "<a href='/sign' class='btn btn-primary mx-1 mt-1'>S'inscrire</a>"
    ?>

    <?php
    foreach ($posts as $post) :
    ?>
        <div class="border p-2 mt-1">
            <span class="badge text-bg-info">test</span>
            <p><?= substr($post->getContent(), 0, 350) . '...' ?></p>
            <a href="/post/<?php echo $post->getId() ?>" class="btn btn-primary btn-sm">Lire la suite</a>
            <a href="/post/<?php echo $post->getId() ?>/update" class="btn btn-warning btn-sm">Modfifier</a>
            <a href="/post/<?php echo $post->getId() ?>/delete" class="btn btn-danger btn-sm">Supprimer</a>
        </div>

    <?php endforeach ?>
    <div class="d-flex justify-content-end mt-3">
        <a href="/new" class="btn btn-primary">Nouveau</a>
    </div>
</div>