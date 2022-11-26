<h1 class="mx-2">Tous les Commentaires</h1>
<div class="mx-2">
    <a href="/" class="btn btn-primary">Retour à l'accueil</a>
    <a href="/account" class="btn btn-primary">Retour</a>
</div>
<table class="table table-striped w-75 m-auto border">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">APERÇU</th>
            <th scope="col">ID COMMENTAIRE PARENT</th>
            <th scope="col">POST</th>
            <th scope="col">ACTIONS</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <?php foreach ($coms as $com) : ?>
                <td scope="row"><?= $com->getId() ?></td>
                <td><?= substr($com->getContent(), 0, 100) ?></td>
                <td><?= $com->getParent_id() ?></td>
                <td><?= $com->post_title ?></td>
                <td class="d-flex gap-1">
                    <a href="post/<?= $com->getPost_id() ?>?admin#<?= $com->getId() ?>" class="btn btn-info btn-sm">AFFICHER</a>
                    <a href="com/<?= $com->getId() ?>/delete?admin" class="btn btn-danger btn-sm">SUPPRIMER</a>
                    <a href="com/<?= $com->getId() ?>/update?admin" class="btn btn-warning btn-sm">MODIFIER</a>
                </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>