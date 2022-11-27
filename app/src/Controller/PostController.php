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

        $userManager = new UserManager(new PDOFactory());

        $posts = $postManager->getAllPosts('desc');
        foreach ($posts as $post) {
            $post->username = $userManager->getUserbyId($post->getAuthor_id())->getUsername();
        }

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
        $post = $postManager->getPostById($id);
        if (!$post) {
            header('location: /?error=post');
            exit;
        }

        /*<----------------- Users ----------------------------->*/
        $userManager = new UserManager(new PDOFactory());
        $user = $userManager->getUserbyId($post->getAuthor_id());

        $post->username = $user->getUsername();



        /*<----------------- Commentaire ----------------------->*/
        $commentsManager = new CommentManager(new PDOFactory());

        $comments = $commentsManager->getAllCommentsbyPost($id);


        $comments_index = [];

        // j'index le tableau
        foreach ($comments as $comment) {
            $comments_index[$comment->getId()] = $comment;
            if ($comment->getId()) {
                if (!$userManager->getUserbyId($comment->getAuthor_id())) {
                    $comments_index[$comment->getId()]->username = 'utilisateur supprimer';
                    continue;
                }
                $comments_index[$comment->getId()]->username = $userManager->getUserbyId($comment->getAuthor_id())->getUsername();
            }
        }

        // //je modifie le tableau
        foreach ($comments as $key => $comment) {
            //je detect s'il y a des enfants
            if ($comment->getParent_id() != null) {
                //je modifie comments car c'est un objet
                $comments_index[$comment->getParent_id()]->children[] = $comment;
                unset($comments[$key]);
            }
        }




        $this->render('posts/post', compact('post', 'comments', 'user'));
    }
    /**
     * @param $id
     * @return void
     */
    #[Route('/post/{id}/update', name: "update-post", methods: ["GET", "POST"])]
    public function updatePost(int $id)
    {
        $postManager = new PostManager(new PDOFactory());
        $userManager = new UserManager(new PDOFactory());

        $post = $postManager->getPostById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $this->render('posts/modify', compact('post'));
        }

        $postManager->updatePost($id, $_POST);
        header('location: /post/' . $id);
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
        strip_tags(extract($_POST));
        $author_id = $_SESSION['auth'];

        $file = $_FILES['img'] ?? null;
        if ($file) {
            move_uploaded_file($file['tmp_name'], './src/assets/' . $file['name']);
            $_POST['img'] = '../../src/assets/' . $file['name'];
        }
        foreach ($_POST as $p) {
            if ($p == null) {
                header('location:/new?error=empty');
                exit;
            }
        }
        $data = array_merge($_POST, ['author_id' => $author_id]);


        $post->hydrate($data);

        $postManager->insertPost($post);

        $lastpost = $postManager->getLastPostbyAuthorID($_SESSION['auth']);


        if ($file) {
            header('location:/post/' . $lastpost->getId() . '?true');
            exit;
        }

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
        $postManager = new PostManager(new PDOFactory());

        $author = $postManager->getPostById($id)->getAuthor_id();




        $userRole = $userManager->getUserbyId($_SESSION['auth'])->getRoles();
        if ($userRole['ROLE'] == 'ADMIN' || $_SESSION['auth'] == $author) {
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
