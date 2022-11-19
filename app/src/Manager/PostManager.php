<?php

namespace App\Manager;

use App\Entity\Post;
use App\Factory\PDOFactory;

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

        $query = $this->pdo->prepare("SELECT content,author_id FROM Post WHERE Post.id = :id");
        $query->bindValue('id', $id, \PDO::PARAM_INT);
        $query->execute();
        $data = $query->fetch(\PDO::FETCH_ASSOC);

        $post = new Post($data);


        if ($post) {
            return $post;
        }
        return null;
    }
    public function insertPost(Post $post)
    {
        $query = $this->pdo->prepare('INSERT INTO Post (content, author_id) VALUES (:content,:author_id)');
        $query->bindValue('content', $post->getContent(), \PDO::PARAM_STR);
        $query->bindValue('author_id', $post->getAuthor_id(), \PDO::PARAM_STR);
        $query->execute();
    }
}
