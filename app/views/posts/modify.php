<h1 style="width: 50%;margin:auto">Modifier le Post</h1>
<form method="post" style="display:flex;flex-direction:column;width:50%;margin:auto">
    <label for="titre">Titre: </label><input type="text" value="<?php echo $title ?>">
    <label for="content">Titre: </label><textarea name="content" id="content" cols="150" rows="30"><?php echo $post->getContent() ?></textarea>
    <input type="submit" style="width: 10%;margin:auto;">
</form>