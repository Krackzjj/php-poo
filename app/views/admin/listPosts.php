<h1 class="mx-2">Tous les Posts</h1>
<table class="table table-striped w-75 m-auto border">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">APERÇU</th>
            <th scope="col">ACTIONS</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($posts as $post) : ?>
            <tr>
                <th scope="row"><?= $post->getId() ?></th>
                <th><?= substr($post->getContent(), 0, 100) . ' ...' ?></th>
                <td>
                    <a href="post/<?= $post->getId() ?>?admin" class="btn btn-info btn-sm">AFFICHER</a>
                    <a href="post/<?= $post->getId() ?>/delete?admin" class="btn btn-danger btn-sm">SUPPRIMER</a>
                    <a href="post/<?= $post->getId() ?>/update?admin" class="btn btn-warning btn-sm">MODIFIER</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<div class="d-flex gap-1 mx-2">
    <a href="/" class="btn btn-primary">Retour à l'accueil</a>
    <a href="/account" class="btn btn-primary">Retour</a>
</div>