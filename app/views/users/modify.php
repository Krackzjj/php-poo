<h1 class="w-50 m-auto">MODIFIER MES INFORMATIONS</h1>
<form method="POST" class="m-auto d-flex flex-column w-25" action="">
    <label class="form-label" for='username'>Pseudo: </label>
    <input class="form-control" type="text" name="username" id="username" value="<?= $user->getUsername() ?>">
    <label class="form-label" for="email">e-mail: </label>
    <input class="form-control" type="email" name="email" id="email" value="<?= $user->getEmail()  ?>">
    <label class="form-label" for="firstName">Prénom: </label>
    <input class="form-control" type="text" name="firstName" id="firstName" value="<?= $user->getFirstName()  ?>">
    <label class="form-label" for="lastName">Nom: </label>
    <input class="form-control" type="text" name="lastName" id="lastName" value="<?= $user->getLastName()  ?>">
    <label class="form-label" for="gender">Genre: </label>
    <input class="form-control" type="text" name="gender" id="gender" value="<?= $user->getGender()  ?>">

    <input type="submit" class="mt-2 btn btn-dark" value="MODIFIER">
</form>