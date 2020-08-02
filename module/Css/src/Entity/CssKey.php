<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 28/07/2020
 * Time: 17:35
 */

namespace Css\Entity;
use Application\Entity\Forum;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;

/**
 * Class CssKey
 * @package Css\Entity
 * @ORM\Entity
 * @ORM\Table(name="css_keys")
 */
class CssKey
{
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
     * @ORM\ManyToOne(targetEntity="Application\Entity\Forum")
     * @ORM\JoinColumn(name="forum_id", referencedColumnName="id")
     */
    protected $forum;

    /**
     * @ORM\Column(name="header")
     */
    protected $header;

    /**
     * @ORM\OneToMany(targetEntity="CssValue", mappedBy="key")
     */
    protected $values;

    public function __construct()
    {
        $this->values = new ArrayCollection();
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
     * @param mixed $id
     * @return CssKey
     */
    public function setId($id):CssKey
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getForumId():int
    {
        return $this->forum_id;
    }

    /**
     * @param mixed $forun_id
     * @return CssKey
     */
    public function setForumId($forum_id):CssKey
    {
        $this->forum_id = $forum_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHeader():string
    {
        return $this->header;
    }

    /**
     * @param mixed $header
     * @return CssKey
     */
    public function setHeader($header):CssKey
    {
        $this->header = $header;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getValues():PersistentCollection
    {
        return $this->values;
    }

    /**
     * @param mixed $values
     * @return CssKey
     */
    public function addValue(CssValue $value):CssKey
    {
        $this->values[] = $value;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getForum():Forum
    {
        return $this->forum;
    }

    /**
     * @param mixed $forum
     * @return CssKey
     */
    public function setForum(Forum $forum):CssKey
    {
        $this->forum = $forum;
        return $this;
    }



}