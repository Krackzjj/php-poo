<div class="container">
    <header>
        <h1>Nouveau Post</h1>
    </header>
    <!-- @TODO ajouté enctype/ -->
    <form method="POST" class="w-100 d-flex flex-column">
        <label for="title">Titre: </label>
        <input type="text" name="title" id="title">
        <label for="content">Contenu: </label>
        <textarea name="content" id="content" cols="150" rows="30" placeholder="Text Here"></textarea>
        <input name="img" id="img" type="text" placeholder="lien vers l'image" class="mt-2">
        <input type="submit" class="btn btn-dark mt-2 w-25">
    </form>
</div>