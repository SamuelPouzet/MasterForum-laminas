<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 11/07/2020
 * Time: 08:50
 */

namespace Application\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;

/**
 * Class ForumSubject
 * @package Application\Entity
 * @ORM\Entity(repositoryClass="Application\Repository\ForumTopicRepository")
 * @ORM\Table(name="forum_topic")
 */
class ForumTopic
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id")
     */
    protected $id;

    /**
     * @ORM\Column(name="subject_id")
     */
    protected $subject_id;

    /**
     * @ORM\ManyToOne(targetEntity="ForumSubject", inversedBy="topics")
     * @ORM\JoinColumn(name="subject_id", referencedColumnName="id")
     */
    protected $subject;

    /**
     * @ORM\Column(name="date_created")
     */
    protected $date_created;

    /**
     * @ORM\Column(name="title")
     */
    protected $title;

    /**
     * @ORM\Column(name="catchphrase")
     */
    protected $catchphrase;

    /**
     * @ORM\Column(name="status")
     */
    protected $status;

    /**
     * @ORM\Column(name="type")
     */
    protected $type;

    /**
     * @ORM\OneToMany(targetEntity="ForumResponse", mappedBy="topic")
     * @ORM\OrderBy({"date_created" = "ASC"})
     */
    protected $responses;

    /**
     * @ORM\OneToOne(targetEntity="Application\Entity\ForumCustomResponse", mappedBy="topic")
     */
    protected $custom_response;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Entity\Template\CustomResponse", inversedBy="topic")
     * @ORM\JoinColumn(name="custom_response_id", referencedColumnName="id")
     */
    protected $custom_template;


    public function __construct()
    {
        $this->responses = new ArrayCollection();
    }

    public function getArrayCopy()
    {
        return get_object_vars($this);
    }

    /**
     * @return int
     */
    public function getId():int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return ForumTopic
     */
    public function setId(int $id):ForumTopic
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getSubjectId():int
    {
        return $this->subject_id;
    }

    /**
     * @param int $subject_id
     * @return ForumTopic
     */
    public function setSubjectId(int $subject_id):ForumTopic
    {
        $this->subject_id = $subject_id;
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
     * @return ForumSubject
     */
    public function setDateCreated(\DateTime $date_created):ForumTopic
    {
        $this->date_created = $date_created->format('Y-m-d H:i:s');
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle():string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return ForumSubject
     */
    public function setTitle(string $title):ForumTopic
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getCatchphrase():string
    {
        return $this->catchphrase;
    }

    /**
     * @param string $catchphrase
     * @return ForumSubject
     */
    public function setCatchphrase(string $catchphrase):ForumTopic
    {
        $this->catchphrase = $catchphrase;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSubject():ForumSubject
    {
        return $this->subject;
    }

    /**
     * @param ForumSubject $subject
     * @return ForumTopic
     */
    public function setSubject(ForumSubject $subject):ForumTopic
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * @return int
     */
    public function getStatus():int
    {
        return $this->status;
    }

    /**
     * @param int $status
     * @return ForumTopic
     */
    public function setStatus(int $status):ForumTopic
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return PersistentCollection
     */
    public function getResponses():PersistentCollection
    {
        return $this->responses;
    }

    /**
     * @param ForumResponse $response
     * @return ForumTopic
     */
    public function addResponse(ForumResponse $response):ForumTopic
    {
        $this->responses[] = $response;
        return $this;
    }

    /**
     * @return ForumTopic
     */
    public function razResponses():ForumTopic
    {
        $this->responses= new ArrayCollection();
        return $this;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     * @return ForumTopic
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCustomResponse()
    {
        return $this->custom_response;
    }

    /**
     * @param mixed $custom_response
     * @return ForumTopic
     */
    public function setCustomResponse($custom_response)
    {
        $this->custom_response = $custom_response;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCustomTemplate()
    {
        return $this->custom_template;
    }

    /**
     * @param mixed $custom_template
     * @return ForumTopic
     */
    public function setCustomTemplate($custom_template)
    {
        $this->custom_template = $custom_template;
        return $this;
    }



}