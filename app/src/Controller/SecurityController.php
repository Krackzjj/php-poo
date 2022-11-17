<?php

namespace App\Controller;

use App\Entity\User;
use App\Factory\PDOFactory;
use App\Manager\UserManager;
use App\Route\Route;

class SecurityController extends AbstractController
{

    #[Route('/sign', name: 'sign-in', methods: ['GET', 'POST'])]
    public function newUser()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $this->render('users/sign.php');
        }
        strip_tags(extract($_POST));

        $user = new User();

        $user->setUsername($username);
        $user->setHashedPassword($pwd);
        $user->setEmail($email);


        $userManager = new UserManager(new PDOFactory());
        $userManager->insertUser($user);
        header('location: /');
        exit;
    }


    #[Route('/login', name: "login", methods: ["GET", "POST"])]
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $this->render('users/login.php');
        }
        strip_tags(extract($_POST));
        $userManager = new UserManager(new PDOFactory());
        $user = $userManager->getByUsername($username);

        if (!$user) {
            header("Location: /?error=notfound");
            exit;
        }

        if ($user->passwordMatch($pwd)) {

            $this->render("users/showUsers.php",);
        }

        header("Location: /?error=notfound");
        exit;
    }
}
