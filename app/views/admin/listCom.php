<h1 class="mx-2">Tous les Commentaires</h1>
<table class="table table-striped w-75 m-auto border">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">APERÇU</th>
            <th scope="col">POST</th>
            <th scope="col">ACTIONS</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <?php foreach ($coms as $com) : ?>
                <th scope="row"><?= $com->getId() ?></th>
                <th><?= substr($com->getContent(), 0, 100) ?></th>
                <th><a href="/post/<?= $com->getPost_id() ?>" target="_blank">TITRE</a></th>
                <td class="d-flex justify-content-center gap-1">
                    <a href="post/?admin" class="btn btn-info btn-sm">AFFICHER</a>
                    <a href="post//delete?admin" class="btn btn-danger btn-sm">SUPPRIMER</a>
                    <a href="post//update?admin" class="btn btn-warning btn-sm">MODIFIER</a>
                </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<div class="mx-2">
    <a href="/" class="btn btn-primary">Retour à l'accueil</a>
    <a href="/account" class="btn btn-primary">Retour</a>
</div>