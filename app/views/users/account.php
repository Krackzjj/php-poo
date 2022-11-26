<header class="mx-2 gap-2 d-flex">
    <h2 class="">Bonjour <?= $user->getUsername(); ?></h2>
    <a href="/" class="btn btn-primary mt-2 btn-sm align-self-start">Retour à l'accueil</a>
    <a href='/logout' class='btn btn-danger btn-sm align-self-start mt-2 '>Déconnexion</a>
</header>


<?php if ($user->getRoles()['ROLE'] && $user->getRoles()['ROLE'] == "ADMIN") : ?>
    <div class="alert alert-success mx-2">Vous êtes Administrateur</div>
    <div class="mx-2 d-flex flex justify-content-start gap-1">
        <a href="/posts" class="btn btn-primary">Liste des posts</a>
        <a href="/users" class="btn btn-primary">Liste des utilisateurs</a>
        <a href="/coms" class="btn btn-primary">Liste des commentaires</a>
    </div>
<?php endif; ?>


<h3 class="mx-2">Informations personelles</h3>
<form method="post" class="d-flex flex-column gap-1 mx-2 w-25" action="/users/<?= $user->getId() ?>/update">
    <label for="username" class="form-label">Username: </label>
    <input type="text" class="form-control" name="username" id="username" value="<?php echo $user->getUsername() ?>">
    <label for="email" class="form-label">E-Mail: </label>
    <input type="email" class="form-control" name="email" id="email" value="<?php echo $user->getEmail() ?>" disabled>
    <label for="firstname" class="form-label">Prénom: </label>
    <input type="text" class="form-control" name="firstName" id="firstName" value="<?php echo $user->getFirstName() ?>">
    <label for="lastName" class="form-label">Nom: </label>
    <input type="text" class="form-control" name="lastName" id="lastName" value="<?php echo $user->getLastName() ?>">
    <label for="gender" class="form-label">Genre: </label>
    <input type="text" class="form-control" name="gender" id="gender" value="<?php echo $user->getGender() ?>">
    <input type="submit" value="Mettre à jour" class="btn btn-secondary">
    <?php if ($user->getRoles()['ROLE'] == 'ADMIN') : ?>
        <input type="hidden" name='ROLE' value="ADMIN">
    <?php endif; ?>
</form>