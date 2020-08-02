<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 14/07/2020
 * Time: 11:42
 */

namespace User\Service;


use Laminas\Authentication\Storage\Session;
use Laminas\Authentication\Storage\StorageInterface;
use Laminas\Crypt\Password\Bcrypt;
use User\Module;

class AuthenticationService
{


    protected $storage;

    public function __construct(StorageInterface $storage = null)
    {
        if($storage){
            $this->storage = $storage;
        }

    }

    public function hasIdentity():bool
    {
        $id_forum = Module::getForumId();

        $userinfo = $this->storage->read();

        if(!isset($userinfo)){
            //user is not logged
            return false;
        }

        if(!isset($userinfo[$id_forum])){
            //user is logged but in another forum
            return false;
        }

        return true;
    }

    public function getIdentity():?string
    {

        if(!$this->hasIdentity()){
            //possible security break
            return null;
        }

        return $this->getStorage()->read()[Module::getForumId()];
    }

    public function getStorage():StorageInterface
    {
        if (null === $this->storage) {
            $this->setStorage(new Session());
        }

        return $this->storage;
    }

    /**
     * Sets the persistent storage handler
     *
     * @param  StorageInterface $storage
     * @return self Provides a fluent interface
     */

    public function setStorage(StorageInterface $storage):AuthenticationService
    {
        $this->storage = $storage;
        return $this;
    }

    public function addToStorage(int $forumId, string $data):AuthenticationService
    {
        $registeredData = $this->getStorage()->read();
        $registeredData[$forumId] = $data;
        $this->getStorage()->write($registeredData);
        return $this;

    }

    public function clearIdentity():bool
    {
        if(!$this->hasIdentity()){
            //possible security break
            return false;
        }

        $sessions = $this->getStorage()->read();
        $id_forum = Module::getForumId();
        unset($sessions[$id_forum]);
        $this->getStorage()->write($sessions);
        return true;
    }

    public function PasswordHash(string $password):string
    {
        $crypt = new Bcrypt();
        $hash = $crypt->create($password);

        return $hash;
    }

}