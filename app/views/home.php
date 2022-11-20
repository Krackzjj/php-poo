    <header class="container d-flex justify-content-center">
        <h1>Tous les Posts</h1>
    </header>
    <?php
    if (isset($_GET['connect'])) { ?>
        <div class="alert alert-success">Compte utilisateur créé avec succès</div>
        <a href='/login' class='btn btn-success mx-1 mt-1'>Connexion</a>
    <?php } elseif (isset($_SESSION['auth'])) { ?>
        <div class="w-100 d-flex justify-content-between">
            <a href="/account" class='btn btn-primary mx-1 mt-1'>Mon Compte</a>
            <a href='/logout' class='btn btn-danger mx-1 mt-1 '>Déconnexion</a>
        </div>
    <?php } else { ?>
        <a href='/sign' class='btn btn-primary mx-1 mt-1'>S'inscrire</a>
        <a href='/login' class='btn btn-success mx-1 mt-1'>Connexion</a>
    <?php } ?>
    <?php
    foreach ($posts as $post) :
    ?>
        <div class="border p-2 mt-1">
            <span class="badge text-bg-info"><?php echo $post->getCreated_at() ?></span>
            <p><?= substr($post->getContent(), 0, 350) . '...' ?></p>
            <a href="/post/<?php echo $post->getId() ?>" class="btn btn-primary btn-sm">Lire la suite</a>
        </div>

    <?php endforeach; ?>
    <div class="d-flex justify-content-end mt-3">
        <a href="<?= isset($_SESSION['auth']) ? '/new' : '' ?>" class="btn btn-primary<?= isset($_SESSION['auth']) ? '' : ' disabled' ?>">Nouveau</a>
    </div>