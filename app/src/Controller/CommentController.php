<?php

namespace App\Controller;

use App\Route\Route;
use App\Traits\Hydrator;
use App\Manager\CommentManager;
use App\Factory\PDOFactory;
use App\Entity\Comment;
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
        $userRole = $userManager->getUserbyId($_SESSION['auth'])->getRoles();
        if ($userRole['ROLE'] == 'ADMIN') {

            $commentManager = new CommentManager(new PDOFactory());
            $coms = $commentManager->getAllComments();
            $this->render('admin/listCom', compact('coms', 'userRole'));
        }
    }
}
