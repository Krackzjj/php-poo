<div class="container">
    <form method="POST" class="w-100 d-flex flex-column">
        <label for="content">Contenu: </label>
        <textarea name="content" id="content" cols="150" rows="30" placeholder="Text Here"><?= $comment->getContent() ?></textarea>
        <div>
            <input type="submit" class="btn btn-dark mt-2 w-25">
            <a href="<?= $_SERVER['HTTP_REFERER'] ?>" class="btn btn-danger mt-2 w-25">Annuler</a>
        </div>
    </form>
</div>