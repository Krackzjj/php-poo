<?php

namespace App\Manager;

use App\Entity\Post;

class PostManager extends BaseManager
{

    /**
     * @return Post[]
     */
    public function getAllPosts(): array
    {
        $query = $this->pdo->query("select * from Post");

        $posts = [];

        while ($data = $query->fetch(\PDO::FETCH_ASSOC)) {
            $posts[] = new Post($data);
        }

        return $posts;
    }

    public function getPostById($id): ?Post
    {
        $query = $this->pdo->prepare("SELECT Post.id, Post.content,User.username FROM Post INNER JOIN User ON Post.author_id = User.id WHERE Post.id = :id");
        $query->bindValue('id', $id, \PDO::PARAM_INT);
        $query->execute();
        $data = $query->fetch(\PDO::FETCH_ASSOC);
        $post = new Post($data);

        if ($post) {
            return $post;
        }
        return null;
    }
}
