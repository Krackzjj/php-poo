    <div class="container">
        <header class="container d-flex flex-column">
            <h2><?= $post->getTitle() ?></h2>
            <img width="300px" class="m-auto" src="<?= $post->getImg() ?>" alt="">
        </header>
        <div class="container">
            <span class="badge text-bg-dark"><?= $post->getCreated_at() ?></span>
            <span class="badge text-bg-dark"><?php echo $post->username ?></span>
            <p><?= $post->getContent() ?></p>
        </div>


        <?php

        if (isset($_SESSION['auth']) && $_SESSION['auth'] == $post->getAuthor_id() || isset($_SESSION['ROLE'])) : ?>
            <a href="/post/<?= $post->getId() ?>/update<?= isset($_SESSION['ROLE']) ? '?admin' : '' ?>" class="btn btn-warning mb-2">EDITER</a>
            <a href="/post/<?= $post->getId() ?>/delete<?= isset($_SESSION['ROLE']) ? '?admin' : '' ?>" class="btn btn-danger mb-2">SUPPRIMER</a>
            <?php if (isset($_SESSION['ROLE'])) : ?>
                <a href="/posts" class="btn btn-primary mb-2">Retour à la liste</a>
            <?php endif; ?>
        <?php endif; ?>
        <a href="/" class="btn btn-primary mb-2">Retour à l'accueil</a>
        <h3>Commentaires :</h3>
        <?php foreach ($comments as $comment) : ?>
            <?php require('comment.php') ?>
        <?php endforeach; ?>
    </div>
    <form action="<?php echo $post->getId() ?>/insert-comment<?= isset($_GET['reply']) ? '?reply=' . $_GET['reply'] : '' ?>" class="m-2" method="post">
        <textarea name="content" id="goto" class="form-control" placeholder="text here"></textarea>
        <input class="btn btn-primary mt-2" type="submit" value="Envoyer">
    </form>
    </div>