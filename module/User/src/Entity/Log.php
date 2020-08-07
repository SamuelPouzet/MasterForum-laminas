<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 07/08/2020
 * Time: 07:43
 */

namespace User\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Log
 * @package User\Entity
 * @ORM\Entity(repositoryClass="\User\Repository\LogRepository")
 * @ORM\Table(name="user_log")
 */
class Log
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @ORM\Column(name="date")
     */
    protected $date;

    /**
     * @return int
     */
    public function getId():int
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Log
     */
    public function setId($id):Log
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return User
     */
    public function getUser():User
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     * @return Log
     */
    public function setUser($user):Log
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDate():\DateTime
    {
        return new \DateTime($this->date);
    }

    /**
     * @param mixed $date
     * @return Log
     */
    public function setDate(\DateTime $date)
    {
        $this->date = $date->format('Y-m-d H:i:s');
        return $this;
    }

}