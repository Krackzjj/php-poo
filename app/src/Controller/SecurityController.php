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
        $roles = ["ROLES" => json_encode(['ROLE' => 'USER'])];
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
            $_SESSION['username'] = $user->getUsername();
            if ($userManager->getUserbyId($_SESSION['auth'])->getRoles()['ROLE'] == 'ADMIN') {
                $_SESSION['ROLE'] = true;
            }
            $this->render('users/showUsers', ['user' => $user]);
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
    #[Route('/account', name: 'account', methods: ['GET'])]
    public function account()
    {
        $userManager = new UserManager(new PDOFactory());

        if (isset($_SESSION)) {
            $user = $userManager->getUserbyId($_SESSION['auth']);
            $this->render('users/showUsers', compact('user'));
        }
        header('location: /?error=notfound');
    }
}
