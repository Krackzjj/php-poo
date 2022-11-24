<?php

namespace App\Controller;

use App\Entity\Post;
use App\Factory\PDOFactory;
use App\Manager\CommentManager;
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
    public function postById(int $id)
    {
        $postManager = new PostManager(new PDOFactory());
        $commentsManager = new CommentManager(new PDOFactory());

        $post = $postManager->getPostById($id);


        $comments = $commentsManager->getAllCommentsbyPost($id);


        $comments_index = [];

        // j'index le tableau
        foreach ($comments as $comment) {
            $comments_index[$comment->getId()] = $comment;
        }

        //je modifie le tableau
        foreach ($comments as $key => $comment) {
            //je detect s'il y a des enfants
            if ($comment->getParent_id() != null) {
                //je modifie comments car c'est un objet
                $comments_index[$comment->getParent_id()]->children[] = $comment;
                unset($comments[$key]);
            }
        }



        if (!$post) {
            header('location: /?error=notfound');
            exit;
        }
        $this->render('posts/post', compact('post', 'comments'));
        if (isset($_GET['admin'])) {
            header('location:/posts');
        }
    }
    /**
     * @param $id
     * @return void
     */
    #[Route('/post/{id}/update', name: "update-post", methods: ["GET", "POST"])]
    public function updatePost(int $id)
    {
        $postManager = new PostManager(new PDOFactory());
        $post = $postManager->getPostById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $this->render('posts/modify', compact('post'));
        }

        $postManager->updatePost($id, $_POST);
        header('location: /post/' . $id . '?admin');
        exit;
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
        extract($_POST);
        $author_id = $_SESSION['auth'];
        $date = new \DateTime();
        $created_at = $date->format('d-m-Y H-i-s');



        $post->hydrate(compact('title', 'content', 'author_id', 'created_at', 'img'));

        $postManager->insertPost($post);

        $lastpost = $postManager->getLastPostbyAuthorID($_SESSION['auth']);

        header("location: /post/" . $lastpost->getId());
        exit;
    }
    /**
     *     * @return void
     */
    #[Route('/post/{id}/delete', name: "delete-post", methods: ["GET"])]
    public function deletePost($id)
    {
        $userManager =  new UserManager(new PDOFactory());
        $userRole = $userManager->getUserbyId($_SESSION['auth'])->getRoles();
        if ($userRole['ROLE'] == 'ADMIN') {
            $postManager = new PostManager(new PDOFactory());
            $postManager->deletePost($id);
        }
        if (isset($_GET['admin'])) {
            header('location: /posts');
            exit;
        }
        header("location: /");
        exit;
    }
    #[Route('/posts', name: "all-posts", methods: ["GET"])]
    public function posts()
    {
        $userManager =  new UserManager(new PDOFactory());
        $userRole = $userManager->getUserbyId($_SESSION['auth'])->getRoles();

        if ($userRole['ROLE'] == 'ADMIN') {
            $postManager = new PostManager(new PDOFactory());
            $posts = $postManager->getAllPosts();
            $this->render('admin/listPosts', compact('posts', 'userRole'));
        }

        header("location: /");
        exit;
    }
}
