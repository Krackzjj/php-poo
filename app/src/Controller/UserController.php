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
}
