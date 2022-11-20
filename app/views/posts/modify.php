<h1 style="width: 50%;margin:auto">Modifier le Post</h1>
<form method="post" style="display:flex;flex-direction:column;width:50%;margin:auto">
    <label for="titre">Titre: </label><input name="title" id="title" type="text" value="<?php echo $post->getTitle() ?>">
    <label for="content">Titre: </label><textarea name="content" id="content" cols="150" rows="30"><?php echo $post->getContent() ?></textarea>
    <label for="img">Lien Image: </label><input type="text" name="img" id="img" value="<?php echo $post->getImg() ?>">
    <input type="submit" style="width: 10%;margin:1rem auto;">
</form>