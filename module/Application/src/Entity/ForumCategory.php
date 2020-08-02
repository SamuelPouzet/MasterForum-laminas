<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 23/07/2020
 * Time: 18:43
 */

namespace Application\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;

/**
 * Class ForumCategory
 * @package Application\Entity
 * @ORM\Entity
 * @ORM\Table(name="forum_category")
 */

class ForumCategory
{

    const STATUS = [
        1=>'Visible',
        2=>'Verrouillé',
        3=>'Masqué',
    ];

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id")
     */
    protected $id;

    /**
     * @ORM\Column(name="forum_id")
     */
    protected $forum_id;

    /**
     * @ORM\ManyToOne(targetEntity="Forum", inversedBy="categories")
     * @ORM\JoinColumn(name="forum_id", referencedColumnName="id")
     */
    protected $forum;

    /**
     * @ORM\OneToMany(targetEntity="ForumSubject", mappedBy="category")
     */
    protected $subjects;

    /**
     * @ORM\Column(name="name")
     */
    protected $name;

    /**
     * @ORM\Column(name="position")
     */
    protected $position;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return ForumCategory
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getForumId()
    {
        return $this->forum_id;
    }

    /**
     * @param mixed $forum_id
     * @return ForumCategory
     */
    public function setForumId($forum_id)
    {
        $this->forum_id = $forum_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getForum()
    {
        return $this->forum;
    }

    /**
     * @param mixed $forum
     * @return ForumCategory
     */
    public function setForum($forum)
    {
        $this->forum = $forum;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return ForumCategory
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param mixed $position
     * @return ForumCategory
     */
    public function setPosition($position)
    {
        $this->position = $position;
        return $this;
    }


    /**
     * @return PersistentCollection
     */
    public function getSubjects():PersistentCollection
    {
        return $this->subjects;
    }

    /**
     * @param ForumSubject $topic
     * @return ForumCategory
     */
    public function addSubject(ForumSubject $subject):ForumCategory
    {
        $this->subjects[] = $subject;
        return $this;
    }

    /**
     * @return ForumCategory
     */
    public function razSubjects():ForumCategory
    {
        $this->subjects= new ArrayCollection();
        return $this;
    }
}