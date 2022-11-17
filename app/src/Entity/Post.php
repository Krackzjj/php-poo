<?php

namespace App\Entity;

class Post extends BaseEntity
{
    private int $id;
    private string $content;
    private int $author_id;
    private int $comment_id;

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
