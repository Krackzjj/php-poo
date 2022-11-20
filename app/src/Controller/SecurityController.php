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
        $roles = ["roles" => json_encode(['role' => 'USER'])];
        $arr = array_merge($_POST, $roles);


        $user = new User();

        $user->hydrate($arr);



        $userManager = new UserManager(new PDOFactory());
        $userManager->insertUser($user);

        header('location: /?connect');
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
            $_SESSION['auth'] = $user->getId();
            $this->render("users/showUsers", ['user' => $user]);
        }

        header("Location: /?error=notfound");
        exit;
    }

    #[Route('/logout', name: 'logout', methods: ['GET'])]
    public function logout()
    {
        session_destroy();
        header('location: /');
        exit;
    }

    #[Route('/users', name: 'all-users', methods: ['GET', 'POST'])]
    public function users()
    {
        $userManager = new UserManager(new PDOFactory());
        $userRole = $userManager->getUserbyId($_SESSION['auth'])->getRoles();

        if ($userRole['role'] == 'ADMIN') {
            die('ok');
        }
        die("t'est user DOMMAGE");
    }
}
