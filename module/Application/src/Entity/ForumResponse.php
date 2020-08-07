<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 11/07/2020
 * Time: 10:48
 */

namespace Application\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class ForumResponse
 * @package Application\Entity
 * @ORM\Entity(repositoryClass = "Application\Repository\ForumResponseRepository")
 * @ORM\Table(name="forum_responses")
 */

class ForumResponse
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id")
     */
    protected $id;

    /**
     * @ORM\Column(name="topic_id")
     */
    protected $topic_id;

    /**
     * @ORM\ManyToOne(targetEntity="ForumTopic", inversedBy="subjects",cascade={"persist"})
     * @ORM\JoinColumn(name="topic_id", referencedColumnName="id")
     */
    protected $topic;


    /**
     * @ORM\Column(name="author_id")
     */
    protected $author_id;

    /**
     * @ORM\ManyToOne(targetEntity="User\Entity\User", inversedBy="posts")
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id")
     */
    protected $author;

    /**
     * @ORM\Column(name="date_created")
     */
    protected $date_created;

    /**
     * @ORM\Column(name="content")
     */
    protected $content;

    public function getArrayCopy():array
    {
        return get_object_vars($this);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return ForumResponse
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTopicId()
    {
        return $this->topic_id;
    }

    /**
     * @param mixed $topic_id
     * @return ForumResponse
     */
    public function setTopicId($topic_id)
    {
        $this->topic_id = $topic_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTopic()
    {
        return $this->topic;
    }

    /**
     * @param mixed $topic
     * @return ForumResponse
     */
    public function setTopic($topic)
    {
        $this->topic = $topic;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     * @return ForumResponse
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDateCreated():\DateTime
    {
        $date = new\DateTime($this->date_created);
        return $date;
    }

    /**
     * @param DateTime $date_created
     * @return ForumResponse
     */
    public function setDateCreated(\DateTime $date_created):ForumResponse
    {
        $this->date_created = $date_created->format('Y-m-d H:i:s');
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAuthorId()
    {
        return $this->author_id;
    }

    /**
     * @param mixed $author_id
     * @return ForumResponse
     */
    public function setAuthorId($author_id)
    {
        $this->author_id = $author_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param mixed $author
     * @return ForumResponse
     */
    public function setAuthor($author)
    {
        $this->author = $author;
        return $this;
    }

}