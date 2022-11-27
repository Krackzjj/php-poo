<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title><?= $_pageTitle; ?></title>
</head>

<body>
    <style>
        .flash {
            position: absolute;
            top: 102%;
        }

        .layout {
            display: flex;
            gap: 1rem;
            width: 100%;
        }

        .nav {
            display: flex;
            position: relative;
            flex-direction: column;
            height: fit-content;
            margin: 1rem;
            position: sticky;
            top: 0;
            width: 15%;
        }
    </style>
    <div class="layout">
        <ul class="nav">
            <?php if ($_SERVER['REQUEST_URI'] != '/') : ?>
                <a href="/" class="btn btn-primary">ACCUEIL</a>
                <br>
            <?php endif; ?>
            <?php if (isset($_SESSION['auth'])) : ?>
                <a href="/logout" class="btn btn-danger mb-1">DÉCONNEXION</a>
                <a href="/account" class="btn btn-primary"><?= "Mon Compte - " . strtoupper($_SESSION['username']) ?></a>
                <br>
                <a href="/new" class="btn btn-primary">NOUVEAU</a>
                <?php if (isset($_SESSION['ROLE']) && $_SESSION['ROLE'] == 'true') : ?>
                    <br>
                    <a href="/posts" class="btn btn-dark mt-1">Liste des posts</a>
                    <a href="/users" class="btn btn-dark mt-1">Liste des utilisateurs</a>
                    <a href="/coms" class="btn btn-dark mt-1">Liste des commentaires</a>
                <?php endif; ?>
            <?php else : ?>
                <?php $uri = preg_match('/\/(sign).*/', $_SERVER['REQUEST_URI']);
                if (!$uri && !isset($_GET['connect'])) :  ?>
                    <a href="/sign" class="btn btn-primary">S'INSCRIRE</a>
                <?php endif;  ?>
                <a href="/login" class="btn btn-dark mt-1">CONNEXION</a>
            <?php endif; ?>
            <?php if (isset($_GET['connect'])) : ?>
                <div class="alert alert-success flash">Compte utilisateur bien enregistré, connexion possible</div>
            <?php elseif (isset($_GET['logout'])) : ?>
                <div class="alert alert-success flash">Déconnexion réussi</div>
            <?php elseif (isset($_GET['error']) && $_GET['error'] == 'empty') : ?>
                <div class="alert alert-danger flash">Tout les champs doivent être remplis</div>
            <?php elseif (isset($_GET['error']) && $_GET['error'] == 'notfound') : ?>
                <div class="alert alert-danger flash">Mauvais identifiants</div>
            <?php elseif (isset($_GET['error']) && $_GET['error'] == 'incorrect') : ?>
                <div class="alert alert-danger flash">Un champs est incorrect</div>
            <?php endif; ?>
        </ul>
        <div class="content w-100">
            <?= $_pageContent; ?>
        </div>
    </div>



    </div>
    </div>
    </div>
</body>

</html>