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
<?php else : ?>
    <div class="alert alert-success mx-2">Bienvenue</div>
<?php endif; ?>


<div class="w-100 d-flex justify-content-between">
    <a href="/" class="btn btn-primary mt-2 mx-2">Retour à l'accueil</a>

</div>