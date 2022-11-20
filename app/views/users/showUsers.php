<header class="mx-2 gap-2 d-flex">
    <h2 class="">Bonjour <?= $user->getUsername(); ?></h2>
    <a href='/logout' class='btn btn-danger btn-sm align-self-start mt-2 '>Déconnexion</a>
</header>


<?php if ($user->getRoles()['ROLE'] && $user->getRoles()['ROLE'] == "ADMIN") : ?>

    <div class="alert alert-success mx-2">Vous êtes Administrateur</div>
    <div class="mx-2 d-flex flex-column justify-content-start gap-1">
        <a href="/posts" class="btn btn-primary" style="width: 10%;">Liste des posts</a>
        <a href="/users" class="btn btn-primary" style="width: 10%;">Liste des utilisateurs</a>
    </div>
<?php endif; ?>


<h3 class="mx-2">Informations personelles</h3>
<form method="post" class="d-flex flex-column gap-1 mx-2 w-25" action="/users/<?= $user->getId() ?>/update">
    <label for="username">Username: </label>
    <input type="text" name="username" id="username" value="<?php echo $user->getUsername() ?>">
    <label for="email">E-Mail: </label>
    <input type="email" name="email" id="email" value="<?php echo $user->getEmail() ?>" disabled>
    <label for="firstname">Prénom: </label>
    <input type="text" name="firstName" id="firstName" value="<?php echo $user->getFirstName() ?>">
    <label for="lastName">Nom: </label>
    <input type="text" name="lastName" id="lastName" value="<?php echo $user->getLastName() ?>">
    <label for="gender">Genre: </label>
    <input type="text" name="gender" id="gender" value="<?php echo $user->getGender() ?>">
    <input type="submit" value="Mettre à jour" class="w-25">
    <?php if ($user->getRoles()['ROLE'] == 'ADMIN') : ?>
        <input type="hidden" name='ROLE' value="ADMIN">
    <?php endif; ?>
</form>


<div class="w-100 d-flex justify-content-between">
    <a href="/" class="btn btn-primary mt-2 mx-2">Retour à l'accueil</a>

</div>