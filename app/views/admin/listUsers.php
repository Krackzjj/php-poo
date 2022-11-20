<h1 class="mx-2">Tous les utilisateurs</h1>
<table class="table table-striped m-auto w-75 border">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">USERNAME</th>
            <th scope="col">FIRST NAME</th>
            <th scope="col">LAST NAME</th>
            <th scope="col">STATUS</th>
            <th scope="col">ACTIONS</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user) : ?>
            <tr>
                <th scope="row"><?= $user->getId() ?></th>
                <td><?= $user->getUsername() ?></td>
                <td><?= $user->getFirstName() ?></td>
                <td><?= $user->getLastName() ?></td>
                <td><?= $user->getRoles()['ROLE'] ?></td>
                <td><a href="<?= $user->getId() == $_SESSION['auth'] ? '' : "users/" . $user->getId() . "/delete" ?>" class=" btn btn-sm <?= $user->getId() == $_SESSION['auth'] ? 'btn-disabled disabled' : 'btn-danger' ?>">SUPPRIMER</a>
                    <a href="users/<?= $user->getId() ?>/update" class="btn btn-warning btn-sm">EDITER</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<div class="d-flex gap-1 mx-2">
    <a href="/" class="btn btn-primary">Retour à l'accueil</a>
    <a href="/account" class="btn btn-primary">Retour</a>
</div>