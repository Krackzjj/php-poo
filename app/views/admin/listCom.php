<h1 class="mx-2">Tous les Commentaires</h1>
<table class="table table-striped w-75 m-auto border">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">APERÇU</th>
            <th scope="col">ID COMMENTAIRE PARENT</th>
            <th scope="col">NOMBRE DE COMMENTAIRES ENFANT</th>
            <th scope="col">POST</th>
            <th scope="col">ACTIONS</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <?php foreach ($coms as $com) : ?>
                <th scope="row"><?= $com->getId() ?></th>
                <td><?= substr($com->getContent(), 0, 100) ?></td>
                <td><?= $com->getParent_id() ?></td>
                <td><?= $com->getChild() ?></td>
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