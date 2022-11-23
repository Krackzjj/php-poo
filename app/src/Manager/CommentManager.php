<?php

namespace App\Manager;

use App\Entity\Comment;

class CommentManager extends BaseManager
{
    public function getAllCommentsByPostId(int $id)
    {
        $query = $this->pdo->prepare(
            'SELECT c.content,c.id,c.created_at,c.author_id,Post.id,c.parent_com,User.username as username  
        FROM Comment as c 
        INNER JOIN Post ON Post.id = c.post_id
        INNER JOIN User ON User.id = c.author_id 
        WHERE Post.id = :id'
        );
        $query->bindValue('id', $id, \PDO::PARAM_INT);
        $query->execute();

        $comments = [];


        while ($data = $query->fetch(\PDO::FETCH_ASSOC)) {
            $comment = new Comment($data);
            $comment->setAuthor_id($data['username']);
            $comments[] = $comment;
        }

        return $comments;
    }
    // public function getRepFromComment(int $id)
    // {
    //     $query = $this->pdo->prepare(
    //         'SELECT c.id,c.content,c.created_at,c.author_id,c.parent_com,User.username as username
    //         FROM Comment as c
    //         INNER JOIN Comment ON c.parent_com = Comment.id
    //         INNER JOIN User ON c.author_id = User.id
    //         WHERE c.id = :id '
    //     );
    //     $query->bindValue('id', $id, \PDO::PARAM_INT);
    //     $query->execute();

    //     $reps = [];

    //     $data = $query->fetch(\PDO::FETCH_ASSOC);
    //     while ($data) {
    //         $rep = new Comment($data);
    //         $rep->setAuthor_id($data['username']);
    //         $reps[] = $rep;
    //     }
    //     return $reps;
    // }
    public function getCommentById($id)
    {
        $query = $this->pdo->prepare(
            'SELECT c.id,c.content,c.created_at,c.author_id,c.parent_com,User.username as username
            FROM Comment as c
            INNER JOIN User ON c.author_id = User.id
            WHERE c.id = :id'
        );
        $query->bindValue('id', $id, \PDO::PARAM_INT);
        $query->execute();
        $data = $query->fetch(\PDO::FETCH_ASSOC);

        return $data ?? null;
    }
}
