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
 * @ORM\Entity(repositoryClass="\Application\Repository\ForumSubjectRepository")
 * @ORM\Table(name="forum_subject")
 */
class ForumSubject
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id")
     */
    protected $id;

    /**
     * @ORM\Column(name="category_id")
     */
    protected $category_id;

    /**
     * @ORM\ManyToOne(targetEntity="ForumCategory", inversedBy="subjects")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    protected $category;

    /**
     * @ORM\OneToMany(targetEntity="ForumSubject", mappedBy="forum")
     */
    protected $subjects;

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
     * @ORM\Column(name="type")
     */
    protected $type;

    /**
     * @ORM\Column(name="status")
     */
    protected $status;

    /**
     * @ORM\OneToMany(targetEntity="ForumTopic", mappedBy="subject")
     */
    protected $topics;

    public function __construct()
    {
        $this->topics = new ArrayCollection();
    }

    public function getArrayCopy():array
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
     * @return ForumSubject
     */
    public function setId(int $id):ForumSubject
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getCategoryId():int
    {
        return $this->category_id;
    }

    /**
     * @param int $category_id
     * @return ForumSubject
     */
    public function setCategoryId(int $categoryId):ForumSubject
    {
        $this->category_id = $categoryId;
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
    public function setDateCreated(\DateTime $date_created):ForumSubject
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
    public function setTitle(string $title):ForumSubject
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
    public function setCatchphrase(string $catchphrase):ForumSubject
    {
        $this->catchphrase = $catchphrase;
        return $this;
    }

    /**
     * @return int
     */
    public function getType():int
    {
        return $this->type;
    }

    /**
     * @param int $type
     * @return ForumSubject
     */
    public function setType(int $type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return ForumSubject
     */
    public function getForum():ForumSubject
    {
        return $this->forum;
    }

    /**
     * @param Forum $forum
     * @return ForumSubject
     */
    public function setForum(Forum $forum):ForumSubject
    {
        $this->forum = $forum;
        return $this;
    }

    /**
     * @return PersistentCollection
     */
    public function getTopics():PersistentCollection
    {
        return $this->topics;
    }

    /**
     * @param ForumTopic $topic
     * @return Forum
     */
    public function addTopic(ForumTopic $topic):ForumSubject
    {
        $this->topics[] = $topic;
        return $this;
    }

    /**
     * @return ForumSubject
     */
    public function razSubjects():ForumSubject
    {
        $this->topics= new ArrayCollection();
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     * @return ForumSubject
     */
    public function setCategory($category)
    {
        $this->category = $category;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSubjects()
    {
        return $this->subjects;
    }

    /**
     * @param mixed $subjects
     * @return ForumSubject
     */
    public function setSubjects($subjects)
    {
        $this->subjects = $subjects;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     * @return ForumSubject
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

}