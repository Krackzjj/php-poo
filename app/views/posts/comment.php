<div class="container">
    <div class="row border border-primary mt-2" id="<?= $comment->getId() ?>">
        <div class="p2">
            <div class="">
                <div class="input-group flex-nowrap mt-2">
                    <span class="input-group-text" id="addon-wrapping">@</span>
                    <input type="text" class="form-control" placeholder="<?= $comment->username ?>" aria-label="Username" aria-describedby="addon-wrapping" disabled>
                </div>
                <span class="badge text-bg-dark align-self-center"><?php echo $comment->getCreated_at() ?></span>



            </div>
            <p><?php echo strip_tags($comment->getContent()) ?></p>

        </div>
        <div class="d-flex gap-1">
            <a href="?reply=<?= $comment->getId() ?>#goto" class="btn btn-primary btn-sm my-2 ml-2">Répondre</a>
            <?php if (isset($_SESSION['auth']) && $_SESSION['auth'] == $comment->getAuthor_id() || isset($_SESSION['ROLE'])) : ?>
                <a href="/com/<?= $comment->getId() ?>/update" class="btn btn-warning btn-sm my-2">Éditer</a>
            <?php endif; ?>
        </div>
    </div>
</div>

<div style="margin-left: 20px;">

    <?php if (isset($comment->children)) :
        foreach ($comment->children as $comment) {
            require('comment.php');
        }
    endif;
    ?>
</div>