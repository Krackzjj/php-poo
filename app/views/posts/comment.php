<div class="container" style="border-bottom: 3px solid #0d6efd;">
    <div class="row">
        <div class="col-12 p-2">
            <p id="<?= $comment->getId() ?>"><?php echo strip_tags($comment->getContent()) ?></p>
            <P><?php echo $comment->getAuthor_id() ?></P>
            <P><?php echo $comment->getCreated_at() ?></P>
        </div>
    </div>
    <div class="row">
        <div class="col-11"></div>
        <div class="col-1">
            <a href="?reply=<?= $comment->getId() ?>#goto" class="btn btn-primary btn-sm mb-1">Répondre</a>
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