<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 11/07/2020
 * Time: 14:30
 */

namespace Application\Entity;
use Doctrine\ORM\Mapping;

/**
 * Class SamCodeElement
 * @package Application\Entity
 * @ORM\Entity
 * @ORM\Column(name="samcode_elements")
 */
class SamCodeElement
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id")
     */
    protected $id;

    /**
     * @ORM\Column(name="presentation")
     */
    protected $presentation;

    /**
     * @ORM\Column(name="html")
     */
    protected $html;

    /**
     * @ORM\Column(name="key_start")
     */
    protected $key_start;

    /**
     * @ORM\Column(name="key_end")
     */
    protected $key_end;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return SamCodeElement
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPresentation()
    {
        return $this->presentation;
    }

    /**
     * @param mixed $presentation
     * @return SamCodeElement
     */
    public function setPresentation($presentation)
    {
        $this->presentation = $presentation;
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
     * @return SamCodeElement
     */
    public function setHtml($html)
    {
        $this->html = $html;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getKeyStart()
    {
        return $this->key_start;
    }

    /**
     * @param mixed $key_start
     * @return SamCodeElement
     */
    public function setKeyStart($key_start)
    {
        $this->key_start = $key_start;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getKeyEnd()
    {
        return $this->key_end;
    }

    /**
     * @param mixed $key_end
     * @return SamCodeElement
     */
    public function setKeyEnd($key_end)
    {
        $this->key_end = $key_end;
        return $this;
    }

}