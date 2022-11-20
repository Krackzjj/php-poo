<?php

namespace App\Controller;

use App\Factory\PDOFactory;
use App\Manager\UserManager;
use App\Route\Route;

class UserController extends AbstractController
{
    #[Route('/user/{username}', name: "username", methods: ["GET"])]
    public function userByUsername($username)
    {
        $manager = new UserManager(new PDOFactory());
        $user = $manager->getByUsername($username);
    }
    #[Route('/users', name: 'all-users', methods: ['GET', 'POST'])]
    public function users()
    {
        $userManager = new UserManager(new PDOFactory());
        $userRole = $userManager->getUserbyId($_SESSION['auth'])->getRoles();

        if ($_SERVER['REQUEST_METHOD'] === 'GET' && $userRole['ROLE'] == 'ADMIN') {

            $userManager = new UserManager(new PDOFactory());
            $users = $userManager->getAllUsers();
            $title = 'list-users';

            $this->render('admin/listUsers', compact('users', 'title'));
        }

        header('location: /?error=not-authorized');
        exit;
    }
    #[Route('/users/{id}/delete', name: 'delete-users', methods: ['GET'])]
    public function deleteUser($id)
    {

        $userManager =  new UserManager(new PDOFactory());
        $userRole = $userManager->getUserbyId($_SESSION['auth'])->getRoles();
        if ($userRole['ROLE'] == 'ADMIN') {
            $userManager->deleteUser($id);
        }
        header('location:' . $_SERVER['HTTP_REFERER']);
        exit;
    }
}
