<?php

namespace App\Manager;

use App\Entity\Comment;

class CommentManager extends BaseManager
{
    public function getAllComments()
    {
        $query = $this->pdo->query('SELECT * FROM Comment');
        $data = $query->fetch(\PDO::FETCH_ASSOC);

        $comments = [];

        while ($data) {
            $comments[] = new Comment($data);
        }
        return $comments;
    }
    public function getAllCommentsbyPost(int $id)
    {
        $query = $this->pdo->prepare('SELECT * FROM Comment WHERE post_id=:id');
        $query->bindValue('id', $id, \PDO::PARAM_INT);
        $query->execute();

        $comments = [];

        while ($data = $query->fetch(\PDO::FETCH_ASSOC)) {
            $comments[] = new Comment($data);
        }
        return $comments;
    }
    public function getAllCommentsId()
    {
        $query = $this->pdo->query('SELECT id FROM Comment');

        $comments = [];

        while ($data = $query->fetch(\PDO::FETCH_ASSOC)) {
            $comments[] = new Comment($data);
        }
        return $comments;
    }
}
