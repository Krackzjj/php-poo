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

        $this->renderJSON([
            "username"=> $user->getUsername()
        ]);
    }
    #[Route('/users', name: 'all-users', methods: ['GET'])]
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
    #[Route('/user/{id}/update', name: 'update-user', methods: ['GET', 'POST'])]
    public function updateUser($id)
    {
        $userManager = new UserManager(new PDOFactory());
        $user_email = $userManager->getUserbyId($id)->getEmail();
        $user = $userManager->getUserbyId($id);

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->render("users/modify", compact('user'));
        }
        $role = json_encode($user->getRoles());


        $data = array_merge(['email' => $user_email, 'ROLE' => $role], $_POST);


        $userManager->updateUser($id, $data);
        if (isset($_GET['admin'])) {
            header('location:/users');
            exit;
        }
        header("location: /account ");
        exit;
    }
}
