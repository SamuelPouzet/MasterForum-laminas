<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 09/08/2020
 * Time: 19:53
 */

namespace Main\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class ForumOwner
 * @package Main\Entity
 * @ORM\Entity
 * @ORM\Table(name="forum_owner")
 */
class ForumOwner
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id")
     */
    protected $id;

    /**
     * @ORM\OneToOne(targetEntity="\Application\Entity\Forum")
     * @ORM\JoinColumns(name="forum_id", referencedColumnName="id")
     */
    protected $forum;

    /**
     * @ORM\Column(name="name")
     */
    protected $name;

    /**
     * @ORM\Column(name="first_name")
     */
    protected $first_name;

    /**
     * @ORM\Column(name="adress")
     */
    protected $adress;

    /**
     * @ORM\Column(name="city")
     */
    protected $city;

    /**
     * @ORM\Column(name="zipcode")
     */
    protected $zipcode;

    /**
     * @ORM\Column(name="ip")
     */
    protected $ip;

    /**
     * @ORM\Column(name="email")
     */
    protected $email;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return ForumOwner
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
     * @return ForumOwner
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
     * @return ForumOwner
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * @param mixed $first_name
     * @return ForumOwner
     */
    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAdress()
    {
        return $this->adress;
    }

    /**
     * @param mixed $adress
     * @return ForumOwner
     */
    public function setAdress($adress)
    {
        $this->adress = $adress;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     * @return ForumOwner
     */
    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * @param mixed $zipcode
     * @return ForumOwner
     */
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @param mixed $ip
     * @return ForumOwner
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     * @return ForumOwner
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

}