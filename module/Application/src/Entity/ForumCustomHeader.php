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
 * Class ForumCustomResponse
 * @package Application\Entity
 * @ORM\Entity
 * @ORM\Table(name="template_custom_header")
 */

class ForumCustomHeader
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id")
     */
    protected $id;



    /**
     * @ORM\OneToOne(targetEntity="Forum", inversedBy="custom_header")
     * @ORM\JoinColumn(name="forum_id", referencedColumnName="id")
     */
    protected $forum;


    /**
     * @ORM\Column(name="html")
     */
    protected $html;

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
     * @return ForumCustomHeader
     */
    public function setId($id)
    {
        $this->id = $id;
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
     * @return ForumCustomHeader
     */
    public function setForum($forum)
    {
        $this->forum = $forum;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHtml()
    {
        return $this->html;
    }

    /**
     * @param mixed $html
     * @return ForumCustomHeader
     */
    public function setHtml($html)
    {
        $this->html = $html;
        return $this;
    }

}