<?php

namespace App\Controller;

use App\Factory\PDOFactory;
use App\Manager\PostManager;
use App\Manager\UserManager;
use App\Route\Route;

class PostController extends AbstractController
{
    #[Route('/', name: "homepage", methods: ["GET"])]
    public function home()
    {
        $manager = new PostManager(new PDOFactory());
        $posts = $manager->getAllPosts();

        $this->render("home.php", [
            "posts" => $posts,
        ], "Tous les posts");
    }

    /**
     * @param $id
     * @return void
     */
    #[Route('/post/{id}', name: "post-id", methods: ["GET"])]
    public function postById($id)
    {
        $manager = new PostManager(new PDOFactory());
        $post = $manager->getPostById($id);
        if (!$post) {
            header('location: /?error=notfound');
            exit;
        }

        $this->render('posts/post.php', [
            "post" => $post,
            "title" => 'Post n°' . $id
        ]);
    }
}
