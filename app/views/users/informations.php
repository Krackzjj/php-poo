<h3 class="mx-2">Informations personelles</h3>
<div class="container justify-content-center">
    <form method="post" class="d-flex flex-column gap-1 mx-2" action="/user/<?= $user->getId() ?>/update">
        <label for="username" class="form-label">Username: </label>
        <input type="text" class="form-control" name="username" id="username" value="<?php echo $user->getUsername() ?>">
        <label for="email" class="form-label">E-Mail: </label>
        <input type="email" class="form-control" name="email" id="email" placeholder="<?php echo $user->getEmail() ?>" disabled>
        <label for="firstname" class="form-label">Prénom: </label>
        <input type="text" class="form-control" name="firstName" id="firstName" value="<?php echo $user->getFirstName() ?>">
        <label for="lastName" class="form-label">Nom: </label>
        <input type="text" class="form-control" name="lastName" id="lastName" value="<?php echo $user->getLastName() ?>">
        <label for="gender" class="form-label">Genre: </label>
        <input type="text" class="form-control" name="gender" id="gender" value="<?php echo $user->getGender() ?>">
        <input type="submit" value="Mettre à jour" class="btn btn-dark w-25 align-self-end">
    </form>
</div>