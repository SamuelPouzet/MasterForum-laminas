<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 25/07/2020
 * Time: 15:16
 */

namespace Application\Entity\Messenger;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Responses
 * @package Application\Entity\Messenger
 * @ORM\Entity
 * @ORM\Table(name="messenger_responses")
 */
class Responses
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id")
     */
    protected $id;

    /**
     * @ORM\Column(name="message_id")
     */
    protected $message_id;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Entity\Messenger\Message")
     * @ORM\JoinColumn(name="message_id", referencedColumnName="id")
     */
    protected $message;

    /**
     * @ORM\Column(name="content")
     */
    protected $content;

    /**
     * @ORM\Column(name="author_id")
     */
    protected $author_id;

    /**
     * @ORM\ManyToOne(targetEntity="User\Entity\User")
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id")
     */
    protected $author;

    /**
     * @ORM\Column(name="date_creation")
     */
    protected $date_creation;

    /**
     * @return integer
     */
    public function getId():int
    {
        return $this->id;
    }

    /**
     * @param integer $id
     * @return Responses
     */
    public function setId(int $id):Responses
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return integer
     */
    public function getMessageId():integer
    {
        return $this->message_id;
    }

    /**
     * @param string $message
     * @return Responses
     */
    public function setMessageId(string $message):Responses
    {
        $this->message_id = $message;
        return $this;
    }

    /**
     * @return string
     */
    public function getContent():string
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return Responses
     */
    public function setContent($content):Responses
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return integer
     */
    public function getAuthorId():int
    {
        return $this->author_id;
    }

    /**
     * @param integer $author_id
     * @return Responses
     */
    public function setAuthorId(int $author_id):Responses
    {
        $this->author_id = $author_id;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDateCreation():\DateTime
    {
        return new \DateTime($this->date_creation);
    }

    /**
     * @param mixed $date_creation
     * @return Responses
     */
    public function setDateCreation(\DateTime $date_creation):Responses
    {
        $this->date_creation = $date_creation->format('Y-m-d H:i:s');
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
     * @return Responses
     */
    public function setAuthor($author)
    {
        $this->author = $author;
        return $this;
    }

    /**
     * @return Message
     */
    public function getMessage():Message
    {
        return $this->message;
    }

    /**
     * @param Message $message
     * @return Responses
     */
    public function setMessage(Message $message):Responses
    {
        $this->message = $message;
        return $this;
    }



}