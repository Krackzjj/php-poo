<h1 class="w-50 m-auto">Modifier le Post</h1>
<form method="post" class="mx-auto w-50 d-flex flex-column">
    <label for="username">Username: </label>
    <input type="text" name="username" id="username" value="<?php echo $user->getUsername() ?>">
    <label for="email">E-Mail: </label>
    <input type="email" name="email" id="email" value="<?php echo $user->getEmail() ?>">
    <label for="firstname">Prénom: </label>
    <input type="text" name="firstName" id="firstName" value="<?php echo $user->getFirstName() ?>">
    <label for="lastName">Nom: </label>
    <input type="text" name="lastName" id="lastName" value="<?php echo $user->getLastName() ?>">
    <label for="gender">Genre: </label>
    <input type="text" name="gender" id="gender" value="<?php echo $user->getGender() ?>">
    <div class="d-flex flex-row gap-2">
        <label for="admin">Administrateur: </label>
        <input type="checkbox" name="ROLE" id="ROLE" value="ADMIN" <?php
                                                                    echo $user->getRoles()['ROLE'] == 'ADMIN' ? 'checked disabled' : '';
                                                                    ?>>
    </div>
    <input type="submit" class="w-25">
    <?php if ($user->getRoles()['ROLE'] == 'ADMIN') : ?>
        <input type="hidden" name='ROLE' value="ADMIN">
    <?php endif; ?>
</form>