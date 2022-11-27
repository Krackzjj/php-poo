<div class="container w-100">
    <header class="mx-2 gap-2 d-flex">
        <h2 class="">Bonjour <?= $user->getUsername(); ?></h2>
    </header>
    <?php if ($user->getRoles()['ROLE'] && $user->getRoles()['ROLE'] == "ADMIN") : ?>
        <div class="alert alert-success mx-2 w-100">Vous êtes Administrateur</div>
    <?php endif; ?>
    <?php require_once('informations.php'); ?>

</div>