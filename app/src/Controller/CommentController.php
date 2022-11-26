<?php

namespace App\Controller;

use App\Route\Route;
use App\Traits\Hydrator;
use App\Manager\CommentManager;
use App\Factory\PDOFactory;
use App\Entity\Comment;
use App\Manager\PostManager;
use App\Manager\UserManager;

class CommentController extends AbstractController
{
    use Hydrator;
    #[Route('/post/{id}/insert-comment', name: 'insert-comment', methods: ['POST'])]
    public function insertComment($id)
    {
        $commentManager = new CommentManager(new PDOFactory());

        $comment = new Comment();

        strip_tags(extract($_POST));
        $author_id = $_SESSION['auth'];
        $post_id = $id;

        $parent_id = $_GET["reply"] ?? 0;



        $comment->hydrate(compact('content', 'post_id', 'parent_id', 'author_id'));



        $commentManager->insertComment($comment);

        $lastcom = $commentManager->getLastCommentbyAuthorId($_SESSION['auth']);

        header("location: /post/$id#" . $lastcom->getId());
        exit;
    }
    #[Route('/coms', name: 'all-coms', methods: ['GET'])]
    public function allComs()
    {
        $userManager = new UserManager(new PDOFactory());
        $postManager = new PostManager(new PDOFactory());
        $userRole = $userManager->getUserbyId($_SESSION['auth'])->getRoles();
        if ($userRole['ROLE'] == 'ADMIN') {
            $commentManager = new CommentManager(new PDOFactory());
            $coms = $commentManager->getAllComments();

            foreach ($coms as $com) {
                if (!$postManager->getPostById($com->getPost_id())) {
                    $com->post_title = 'LE POST A ÉTÉ SUPPRIMER';
                } else {
                    $com->post_title = $postManager->getPostById($com->getPost_id())->getTitle();
                }
            }
            $this->render('admin/listCom', compact('coms', 'userRole'));
        }
    }
    #[Route('/com/{id}/delete', name: 'delete-com', methods: ['GET'])]
    public function deleteComment($id)
    {
        $userManager = new UserManager(new PDOFactory());
        $postManager = new PostManager(new PDOFactory());
        $commentManager = new CommentManager(new PDOFactory());

        $user = $userManager->getUserbyId($_SESSION['auth']);



        if ($user->getRoles()['ROLE'] == 'ADMIN') {
            $hasParent = $commentManager->getCommentbyId($id)->getParent_id();
            $hasPost = $postManager->getPostById($commentManager->getCommentbyId($id)->getPost_id());

            //si le commentaire est la racine et que le post est toujours en ligne
            if ($hasParent == 0 && $hasPost) {
                $commentManager->updateComment($id, "CONTENU MODÉRE - BY " . ucfirst($user->getUsername()));
                header('location:/coms');
                exit;
            }

            $commentManager->deleteComment($id);
            header('location:/coms');
            exit;
        }
    }
    #[Route('/com/{id}/update', name: 'update-comment', methods: ['GET', 'POST'])]
    public function updateComment(int $id)
    {
        $commentManager = new CommentManager(new PDOFactory());
        $comment = $commentManager->getCommentbyId($id);
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->render('posts/comment/update', compact('comment'));
        }
        $content = $_POST['content'];
        $commentManager->updateComment($id, $content);
        if (isset($_GET['admin'])) {
            header('location: /coms');
            exit;
        }
        header("location: /post/" . $comment->getPost_id() . "#$id");
        exit;
    }
}
