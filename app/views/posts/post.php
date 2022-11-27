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
            <a href="/post/<?= $post->getId() ?>/update<?= isset($_SESSION['ROLE']) ? '?admin' : '' ?>" class="btn btn-warning btn-sm ">EDITER</a>
            <a href="/post/<?= $post->getId() ?>/delete<?= isset($_SESSION['ROLE']) ? '?admin' : '' ?>" class="btn btn-danger btn-sm ">SUPPRIMER</a>
        <?php endif; ?>
        <h3>Commentaires :</h3>
        <?php foreach ($comments as $comment) : ?>
            <?php require('comment.php') ?>
        <?php endforeach; ?>
    </div>
    <?php
    $reply = isset($_GET['reply']) ? ("?reply=" . $_GET['reply']) : '';
    $admin = isset($_GET['admin']) ? ("") : '';

    ?>
    <form action="<?= $post->getId() ?>/insert-comment<?= $reply ?>" class="m-2" method="post">
        <textarea name="content" id="goto" class="form-control" placeholder="text here"></textarea>
        <input class="btn btn-primary mt-2" type="submit" value="Envoyer">
    </form>
    </div>
    <script>
        let hash = (window.location.hash).substring(1)
        if (hash != 'goto') {
            let com = document.getElementById(hash)
            if (com) {
                com.classList.remove('border-primary')
                com.style.backgroundColor = 'rgb(12, 110, 253,0.2)'
                com.style.fontWeight = 'bold'
            }
        }
    </script>