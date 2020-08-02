<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 01/08/2020
 * Time: 09:48
 */

namespace Application\Entity\Template;
use Application\Entity\ForumTopic;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class CustomResponse
 * @package Application\Entity\Template
 * @ORM\Entity
 * @ORM\Table(name="template_custom_response")
 */
class CustomResponse
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="Application\Entity\ForumTopic", mappedBy="custom_template")
     */
    protected $topics;

    /**
     * @ORM\Column(name="variables")
     */
    protected $variables;

    /**
     * @ORM\Column(name="html")
     */
    protected $html;

    public function __construct()
    {
        $this->topics = new ArrayCollection();
    }

    public function getArrayCopy()
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
     * @return CustomResponse
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTopics()
    {
        return $this->topics;
    }

    /**
     * @param mixed $topic
     * @return CustomResponse
     */
    public function addTopic(ForumTopic $topic)
    {
        $this->topics[] = $topic;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getVariables()
    {
        return $this->variables;
    }

    /**
     * @param mixed $variables
     * @return CustomResponse
     */
    public function setVariables($variables)
    {
        $this->variables = $variables;
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
     * @return CustomResponse
     */
    public function setHtml($html)
    {
        $this->html = $html;
        return $this;
    }

}