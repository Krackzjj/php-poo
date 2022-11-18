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

    public function getPostById($id): ?array
    {

        $query = $this->pdo->prepare("SELECT content,author_id,username FROM Post JOIN User ON author_id = User.id WHERE Post.id = :id");
        $query->bindValue('id', $id, \PDO::PARAM_INT);
        $query->execute();
        $data = $query->fetch(\PDO::FETCH_ASSOC);

        $post = new Post($data);
        $username = $data['username'];


        if ($post) {
            return compact('post', 'username');;
        }
        return null;
    }
}
