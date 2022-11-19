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
        $postManager = new PostManager(new PDOFactory());

        $posts = $postManager->getAllPosts();

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
        $author = $userManager->getUserbyId($post->getAuthor_id())->getUsername();


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
     * @param $id
     * @return void
     */
    #[Route('/post/{id}/update', name: "update-post", methods: ["GET", "PUT"])]
    public function updatePost($id)
    {
        $postManager = new PostManager(new PDOFactory());
        $userManager = new UserManager(new PDOFactory());

        $post = $postManager->getPostById($id);
        $author = $userManager->getUserbyId($post->getAuthor_id())->getUsername();

        if (!$post) {
            header('location: /?error=notfound');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $this->render('posts/modify', [
                "post" => $post,
                "author" => $author,
                "title" => "Post n°" . $id
            ]);
        }
    }
    /**
     *     * @return void
     */
    #[Route('/new', name: "new-post", methods: ["GET", "POST"])]
    public function insertPost()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $this->render('posts/new');
        }
        $postManager = new PostManager(new PDOFactory());

        $post = new Post();
        $content = $_POST['content'];
        $author_id = $_SESSION['auth'];
        $date = new \DateTime();
        $created_at = $date->format('d-m-Y');
        $img = $_POST['img'];


        $post->hydrate(['content' => $content, 'author_id' => $author_id, 'created_at' => $created_at, 'img' => $img]);

        $postManager->insertPost($post);

        header("location: /");
        exit;
    }
    /**
     *     * @return void
     */
    #[Route('/post/{id}/delete', name: "delete-post", methods: ["GET"])]
    public function deletePost($id)
    {
        //@TODO restreindre au role Admin
        $userManager =  new UserManager(new PDOFactory());
        // if($userManager->getUserbyId($_SESSION['auth'])->getRoles())

        $postManager = new PostManager(new PDOFactory());
        $postManager->deletePost($id);
        header("location: /");
        exit;
    }
}
