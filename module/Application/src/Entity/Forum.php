<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 27/12/2019
 * Time: 16:21
 */

namespace Application\Entity;

use Application\Entity\Template\Elements;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;


/**
 * Class Forum
 * @package Application\Entity
 * @ORM\Entity
 * @ORM\Table(name="forum")
 */
class Forum
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id")
     */
    protected $id;

    /**
     * @ORM\Column(name="name")
     */
    protected $name;

    /**
     * @ORM\Column(name="description")
     */
    protected $description;

    /**
     * @ORM\Column(name="icon")
     */
    protected $icon;

    /**
     * @ORM\Column(name="date_create")
     */
    protected $date_create;

    /**
     * @ORM\OneToMany(targetEntity="ForumCategory", mappedBy="forum")
     */
    protected $categories;

    /**
     * @ORM\OneToOne(targetEntity="Application\Entity\Template\Elements", mappedBy="forum")
     */
    protected $elements;

    /**
     * @ORM\OneToOne(targetEntity="Application\Entity\ForumCustomHeader", mappedBy="forum")
     */
    protected $custom_header;

    /**
     * Forum constructor.
     */
    public function __construct()
    {
        $this->categories = new ArrayCollection();
        //$this->elements = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Forum
     */
    public function setId(int $id): Forum
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Forum
     */
    public function setName(string $name): Forum
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDateCreate(): \DateTime
    {
        $date = new \DateTime($this->date_create);
        return $date;
    }

    /**
     * @param DateTime $date_create
     * @return Forum
     */
    public function setDateCreate(\DateTime $date_create): Forum
    {
        $this->date_create = $date_create->format('Y-m-d H:i:s');
        return $this;
    }


    /**
     * @return mixed
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * @param mixed $icon
     * @return Forum
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCategories(): PersistentCollection
    {
        return $this->categories;
    }

    /**
     * @return Forum
     */
    public function razCategories(): Forum
    {
        $this->categories = new ArrayCollection();
        return $this;
    }

    /**
     * @return Forum
     */
    public function addCategory(): Forum
    {
        $this->categories = new ArrayCollection();
        return $this;
    }

    /**
     * @return PersistentCollection
     */
    public function getElements():?Elements
    {
        return $this->elements;
    }

    /**
     * @return mixed
     */
    public function getCustomHeader()
    {
        return $this->custom_header;
    }

    /**
     * @param mixed $custom_header
     * @return Forum
     */
    public function setCustomHeader($custom_header)
    {
        $this->custom_header = $custom_header;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription():string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Forum
     */
    public function setDescription(string $description):Forum
    {
        $this->description = $description;
        return $this;
    }



}
//
//    /**
//     * @param mixed $elements
//     * @return Forum
//     */
//    public function addElement(Elements $element):Forum
//    {
//        $this->elements[] = $element;
//        return $this;
//    }
//
//    /**
//     * @param mixed $elements
//     * @return Forum
//     */
//    public function razElements():Forum
//    {
//        $this->elements = new ArrayCollection();
//        return $this;
//    }
//*/
//}