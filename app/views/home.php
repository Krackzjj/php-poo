    <header class="container d-flex justify-content-center">
        <h1>Tous les Posts</h1>
    </header>
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
                        <span class="badge text-bg-secondary"><?= $post->username ?></span>
                    </div>
                    <p><?= substr($post->getContent(), 0, 350) . '...' ?></p>
                    <a href="/post/<?php echo $post->getId() ?>" class="btn btn-primary btn-sm">Lire la suite</a>
                </div>
            </div>
        </div>

    <?php endforeach; ?>