<?php

namespace App\Entity;

use App\Factory\PDOFactory;
use App\Manager\UserManager;

class Post extends BaseEntity
{
    private ?int $id = null;
    private ?string $title = null;
    private ?string $content = null;
    private ?int $author_id = null;
    private ?string $created_at = null;
    private ?string $img = null;


    /**
     * Get the value of author_id
     */
    public function getAuthor_id(): int
    {
        return $this->author_id;
    }

    /**
     * Set the value of author_id
     *
     * @return  User
     */
    public function setAuthor_id($author_id): Post
    {
        $this->author_id = $author_id;

        return $this;
    }

    /**
     * Get the value of content
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * Set the value of content
     *
     * @return  User
     */
    public function setContent($content): Post
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get the value of id
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  User
     */
    public function setId(int $id): Post
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of created_at
     */
    public function getCreated_at(): string
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     *
     * @return  User
     */
    public function setCreated_at(string $created_at): Post
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Get the value of img
     */
    public function getImg(): string
    {
        return $this->img;
    }

    /**
     * Set the value of img
     *
     * @return  self
     */
    public function setImg($img): Post
    {
        $this->img = $img;

        return $this;
    }

    /**
     * Get the value of title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }
}
