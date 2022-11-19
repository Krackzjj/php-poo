<?php

namespace App\Controller;

use App\Entity\User;
use App\Factory\PDOFactory;
use App\Manager\UserManager;
use App\Route\Route;
use App\Traits\Hydrator;

class SecurityController extends AbstractController
{
    use Hydrator;
    #[Route('/sign', name: 'sign-in', methods: ['GET', 'POST'])]
    public function newUser()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $this->render('users/sign');
        }
        strip_tags(extract($_POST));

        $user = new User();

        $user->hydrate($_POST);


        $userManager = new UserManager(new PDOFactory());
        $userManager->insertUser($user);
        header('location: /');
        exit;
    }


    #[Route('/login', name: "login", methods: ["GET", "POST"])]
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $this->render('users/login');
        }
        strip_tags(extract($_POST));
        $userManager = new UserManager(new PDOFactory());
        $user = $userManager->getByUsername($username);



        if (!$user) {
            header("Location: /?error=notfound");
            exit;
        }

        if ($user->passwordMatch($pwd)) {
            // echo '<pre>';
            // var_dump($user);
            // echo '</pre>';
            // die();
            $this->render("users/showUsers", ['user' => $user]);
        }

        header("Location: /?error=notfound");
        exit;
    }
}
