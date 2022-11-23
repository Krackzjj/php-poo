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
            <div>
                <a href="<?= isset($_SESSION['auth']) ? '/new' : '' ?>" class="btn btn-primary<?= isset($_SESSION['auth']) ? '' : ' disabled' ?>">Nouveau</a>
            </div>
            <a href='/logout' class='btn btn-danger mx-1 mt-1 '>Déconnexion</a>
        </div>
    <?php } else { ?>
        <a href='/sign' class='btn btn-primary mx-1 mt-1'>S'inscrire</a>
        <a href='/login' class='btn btn-success mx-1 mt-1'>Connexion</a>
    <?php } ?>
    <?php
    foreach ($posts as $post) :
    ?>
        <div class="container border p-2 mt-1">
            <div class="row">
                <div class="col-2">
                    <img class="img-thumbnail" style="height:100%;" src="<?= $post->getImg()  ?>" alt="">
                </div>
                <div class="col-10">
                    <h4><?= $post->getTitle() ?></h4>
                    <div class="d-flex gap-1 w-25">
                        <span class="badge text-bg-info"><?php echo $post->getCreated_at() ?></span>
                        <span class="badge text-bg-secondary"><?php echo ucfirst($post->getAuthor_id()) ?></span>
                    </div>
                    <p><?= substr($post->getContent(), 0, 350) . '...' ?></p>
                    <a href="/post/<?php echo $post->getId() ?>" class="btn btn-primary btn-sm">Lire la suite</a>
                </div>
            </div>
        </div>

    <?php endforeach; ?>