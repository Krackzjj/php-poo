<div class="container">
    <header>
        <h1>Nouveau Post</h1>
    </header>
    <form method="POST" class="w-100 d-flex flex-column" enctype='multipart/form-data'>
        <label for="title">Titre: </label>
        <input type="text" name="title" id="title">
        <label for="content">Contenu: </label>
        <textarea name="content" id="content" cols="150" rows="30" placeholder="Text Here"></textarea>
        <input name="img" id="img" type="<?= isset($_GET['send']) ? 'file' : 'text' ?>" placeholder="lien vers l'image" class="mt-2">
        <?php if (isset($_GET['send'])) : ?>
            <a href="/new">Ou envoyez le lien vers l'image ...</a>
        <?php else : ?>
            <a href="?send">Ou envoyez votre image...</a>
        <?php endif; ?>
        <div>
            <input type="submit" class="btn btn-dark mt-2 w-25">
            <a href="/" class="btn btn-danger mt-2 w-25">Annuler</a>
        </div>
    </form>
</div>