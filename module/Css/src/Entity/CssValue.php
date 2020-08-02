<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 28/07/2020
 * Time: 17:45
 */

namespace Css\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class CssValue
 * @package Css\Entity
 * @ORM\Entity
 * @ORM\Table(name="css_values")
 */
class CssValue
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id")
     */
    protected $id;

    /**
     * @ORM\Column(name="css_key_id")
     */
    protected $css_key_id;

    /**
     * @ORM\ManyToOne(targetEntity="CssKey", inversedBy="values")
     * @ORM\JoinColumn(name="css_key_id", referencedColumnName="id")
     */
    protected $key;


    /**
     * @ORM\Column(name="value")
     */
    protected $value;

    /**
     * @ORM\Column(name="attribute")
     */
    protected $attribute;

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
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getCssKeyId()
    {
        return $this->css_key_id;
    }

    /**
     * @param mixed $css_key_id
     */
    public function setCssKeyId($css_key_id): void
    {
        $this->css_key_id = $css_key_id;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value): void
    {
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getAttribute()
    {
        return $this->attribute;
    }

    /**
     * @param mixed $attribute
     */
    public function setAttribute($attribute): void
    {
        $this->attribute = $attribute;
    }

    /**
     * @return mixed
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param mixed $key
     * @return CssValue
     */
    public function setKey($key)
    {
        $this->key = $key;
        return $this;
    }
}