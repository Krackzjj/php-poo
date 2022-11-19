<?php

namespace App\Controller;

use App\Entity\Post;
use App\Factory\PDOFactory;
use App\Manager\PostManager;
use App\Manager\UserManager;
use App\Route\Route;
use App\Traits\Hydrator;

class PostController extends AbstractController
{
    use Hydrator;
    #[Route('/', name: "homepage", methods: ["GET"])]
    public function home()
    {
        $manager = new PostManager(new PDOFactory());
        $posts = $manager->getAllPosts();

        $this->render("home", [
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
        $postManager = new PostManager(new PDOFactory());
        $userManager = new UserManager(new PDOFactory());

        $post = $postManager->getPostById($id);
        $author = $userManager->getByUserbyId($post->getAuthor_id())->getUsername();

        if (!$post) {
            header('location: /?error=notfound');
            exit;
        }

        $this->render('posts/post', [
            "post" => $post,
            "author" => $author,
            "title" => 'Post n°' . $id
        ]);
    }
    /**
     *     * @return void
     */
    #[Route('/new', name: "post-id", methods: ["GET", "POST"])]
    public function insertPost()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $this->render('posts/new');
        }
        $content = strip_tags($_POST['content']);
        $author_id = 1;
        //@TODO doit venir de la session

        $post = new Post();

        $post->hydrate(compact('content', 'author_id'));

        $postManager = new PostManager(new PDOFactory());
        $postManager->insertPost($post);
        header('location: /');
        exit;
    }
}
