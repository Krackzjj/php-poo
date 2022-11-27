<?php

namespace App\Manager;

use App\Entity\Comment;

class CommentManager extends BaseManager
{
    public function getAllComments()
    {
        $query = $this->pdo->query('SELECT * FROM Comment');
        $coms = [];
        while ($data = $query->fetch(\PDO::FETCH_ASSOC)) {
            $coms[] = new Comment($data);
        }
        return $coms;
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
    public function insertComment(Comment $comment)
    {
        if ($comment->getContent() == null || $comment->getContent() == ' ') {
            header('location:/post/' . $comment->getPost_id() . '?error=empty#goto');
            exit;
        }


        $query = $this->pdo->prepare("INSERT INTO Comment (content,post_id,parent_id,author_id) VALUES (:content,:post_id,:parent_id,:author_id)");
        $query->bindValue('content', $comment->getContent(), \PDO::PARAM_STR);
        $query->bindValue('post_id', $comment->getPost_id(), \PDO::PARAM_INT);
        $query->bindValue('parent_id', $comment->getParent_id(), \PDO::PARAM_INT);
        $query->bindValue('author_id', $comment->getAuthor_id(), \PDO::PARAM_INT);
        $query->execute();
    }
    public function getLastCommentbyAuthorId(int $id)
    {
        $query = $this->pdo->prepare('SELECT * FROM Comment WHERE author_id=:id ORDER BY id DESC LIMIT 1');
        $query->bindValue('id', $id, \PDO::PARAM_INT);
        $query->execute();
        $data = $query->fetch(\PDO::FETCH_ASSOC);

        $comment = new Comment($data);
        if ($comment) {
            return $comment;
        }
        return null;
    }
    public function deleteComment(int $id)
    {
        $query = $this->pdo->prepare('DELETE FROM Comment WHERE id=:id');
        $query->bindValue('id', $id, \PDO::PARAM_INT);
        $query->execute();
    }
    public function getCommentbyId(int $id)
    {
        $query = $this->pdo->prepare('SELECT * FROM Comment WHERE id=:id');
        $query->bindValue('id', $id, \PDO::PARAM_INT);
        $query->execute();

        while ($data = $query->fetch(\PDO::FETCH_ASSOC)) {
            $comment = new Comment($data);
            return $comment;
        }
        return null;
    }
    public function updateComment(int $id, string $content)
    {
        $query = $this->pdo->prepare('UPDATE Comment SET content = :content WHERE id=:id');
        $query->bindValue('id', $id, \PDO::PARAM_INT);
        $query->bindValue('content', $content, \PDO::PARAM_STR);
        $query->execute();
    }
    public function updateChild(int $id, int $nbr)
    {
        if ($nbr < 0) {
            $nbr = 0;
        }
        $query = $this->pdo->prepare('UPDATE Comment SET child = :child WHERE id=:id');
        $query->bindValue('id', $id, \PDO::PARAM_INT);
        $query->bindValue('child', $nbr, \PDO::PARAM_INT);
        $query->execute();
    }
}
