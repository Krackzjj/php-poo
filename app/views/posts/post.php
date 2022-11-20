<div class="container">
    <header class="container d-flex flex-column">
        <h2><?= $title ?></h2>
        <img width="300px" class="m-auto" src="<?= $post->getImg() ?>" alt="">
    </header>
    <div class="container">
        <span class="badge text-bg-dark"><?php echo $post->getCreated_at() ?></span>
        <span class="badge text-bg-dark"><?php echo $author ?></span>
        <p><?= $post->getContent() ?></p>
    </div>
    <a href="/" class="btn btn-primary">Retour</a>

</div>