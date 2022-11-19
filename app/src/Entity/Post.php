<?php

namespace App\Entity;

use App\Factory\PDOFactory;
use App\Manager\UserManager;

class Post extends BaseEntity
{
    private ?int $id = null;
    private ?string $content = null;
    private ?int $author_id = null;
    private ?int $comment_id = null;

    /**
     * Get the value of comment_id
     */
    public function getComment_id()
    {
        return $this->comment_id;
    }

    /**
     * Set the value of comment_id
     *
     * @return  self
     */
    public function setComment_id($comment_id)
    {
        $this->comment_id = $comment_id;

        return $this;
    }

    /**
     * Get the value of author_id
     */
    public function getAuthor_id()
    {
        return $this->author_id;
    }

    /**
     * Set the value of author_id
     *
     * @return  self
     */
    public function setAuthor_id($author_id)
    {
        $this->author_id = $author_id;

        return $this;
    }

    /**
     * Get the value of content
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the value of content
     *
     * @return  self
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
