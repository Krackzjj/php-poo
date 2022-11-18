<?php

namespace App\Manager;

use App\Entity\Comment;

class CommentManager extends BaseManager
{
    /**
     * @return Comment[]
     */
    public function getAllCommentsbyPostId(): array
    {
        $query = $this->pdo->query("SELECT * from Comment JOIN Comments ON post_id = post_id WHERE Comment.post_id = :id");

        $comments = [];

        while ($data = $query->fetch(\PDO::FETCH_ASSOC)) {
            $comments[] = new Comment($data);
        }

        return $comments;
    }
    /**
     * @return Comment[]
     */
    public function getCommentsbyPost(int $post_id): array
    {

        $query = $this->pdo->prepare("select * from Comment join Comments on post_id = Comments.post_id where post_id = :post_id");
        $query->bindParam('post_id', $post_id, \PDO::PARAM_INT);
        $query->execute();

        $comments = [];


        while ($data = $query->fetch(\PDO::FETCH_ASSOC)) {
            $comments[] = new Comment($data);
        }

        return $comments;
    }
}
