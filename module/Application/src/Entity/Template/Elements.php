<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 30/07/2020
 * Time: 19:26
 */

namespace Application\Entity\Template;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Elements
 * @package Application\Entity\Template
 * @ORM\Entity
 * @ORM\Table(name="template_elements")
 */
class Elements
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id")
     */
    protected $id;


    /**
     * @ORM\OneToOne(targetEntity="Application\Entity\Forum", inversedBy="elements")
     * @ORM\JoinColumn(name="forum_id", referencedColumnName="id")
     */
    protected $forum;

    /**
     * @ORM\Column(name="header_image")
     */
    protected $header_image;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Elements
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
     * @return Elements
     */
    public function setForum($forum)
    {
        $this->forum = $forum;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHeaderImage()
    {
        return $this->header_image;
    }

    /**
     * @param mixed $header_image
     * @return Elements
     */
    public function setHeaderImage($header_image)
    {
        $this->header_image = $header_image;
        return $this;
    }

}