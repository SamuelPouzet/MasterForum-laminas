<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 20/07/2020
 * Time: 13:39
 */

namespace Application\Entity\Messenger;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Message
 * @package Application\Entity\Messenger
 * @ORM\Entity
 * @ORM\Table(name="messenger_message")
 */
class Message
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id")
     */
    protected $id;

    /**
     * @ORM\Column(name="title")
     */
    protected $title;

    /**
     * @ORM\Column(name="forum_id")
     */
    protected $forumId;

    /**
     * @ORM\ManyToMany(targetEntity="User\Entity\User", inversedBy="messages")
     * @ORM\JoinTable(name="messenger_message_user",
     *      joinColumns={@ORM\JoinColumn(name="message_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")}
     *      )
     */
    private $contributors;

    public function __construct()
    {
        $this->contributors = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId():int
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Message
     */
    public function setId($id):Message
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTitle():string
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     * @return Message
     */
    public function setTitle($title):Message
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getForumId():int
    {
        return $this->forum;
    }

    /**
     * @param mixed $forum
     * @return Message
     */
    public function setForumId($forum):Message
    {
        $this->forum = $forum;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getContributors():ArrayCollection
    {
        return $this->contributors;
    }




}