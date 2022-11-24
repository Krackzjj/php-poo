<div class="border">
    <div class="panel-body">
        <p><?php echo strip_tags($comment->getContent()) ?></p>
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