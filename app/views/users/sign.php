<?php if (isset($_GET['error'])) :
    extract($_SESSION['temp']);
endif;
?>

<form method="POST" class="m-auto d-flex flex-column w-25">
    <label class="form-label" for='username'>Pseudo: </label>
    <input class="form-control" type="text" name="username" id="username" value="<?= isset($username) ? $username : '' ?>">
    <label class="form-label" for="hashedPassword">Mot de passe: </label>
    <input class="form-control" type="password" name="hashedPassword" id="hashedPassword" value="<?= isset($hashedPassword) ? $hashedPassword : '' ?>">
    <label class="form-label" for="email">e-mail: </label>
    <input class="form-control" type="email" name="email" id="email" value="<?= isset($email) ? $email : '' ?>" placeholder="email@email.fr">
    <label class="form-label" for="firstName">Prénom: </label>
    <input class="form-control" type="text" name="firstName" id="firstName" value="<?= isset($firstName) ? $firstName : '' ?>">
    <label class="form-label" for="lastName">Nom: </label>
    <input class="form-control" type="text" name="lastName" id="lastName" value="<?= isset($lastName) ? $lastName : '' ?>">
    <label class="form-label" for="gender">Genre: </label>
    <input class="form-control" type="text" name="gender" id="gender" value="<?= isset($gender) ? $gender : '' ?>" placeholder="la première lettre uniquement">
    <input type="submit" class="mt-2 btn btn-primary" value="SIGN">
</form>