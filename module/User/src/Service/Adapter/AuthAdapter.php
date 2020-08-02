<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 14/07/2020
 * Time: 12:46
 */

namespace User\Service\Adapter;


use Doctrine\ORM\EntityManager;
use Laminas\Authentication\Adapter\AdapterInterface;
use Laminas\Authentication\Result;
use Laminas\Crypt\Password\Bcrypt;
use User\Entity\User;
use User\Module;

class AuthAdapter implements AdapterInterface
{

    /**
     * User email.
     * @var string
     */
    private $email;

    /**
     * Password
     * @var string
     */
    private $password;


    /**
     * Entity manager.
     * @var Doctrine\ORM\EntityManager
     */
    private $entityManager;

    /**
     * Constructor.
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Sets user email.
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Sets password.
     */
    public function setPassword($password)
    {
        $this->password = (string)$password;
    }

    public function authenticate():Result
    {
        $user = $this->entityManager->getRepository(User::class)->findOneBy([
            'forum_id'=>Module::getForumId(),
            'email'=>$this->email,
        ]);

        if(!$user){
            //no such user with this email for this forum

            return new Result(
                Result::FAILURE_IDENTITY_NOT_FOUND,
                null,
                ['Invalid credentials.']);

        }else{

            if ($user->getStatus()==User::STATUS_RETIRED) {
                return new Result(
                    Result::FAILURE,
                    null,
                    ['User is retired.']);
            }

            $bcrypt = new Bcrypt();
            $passwordHash = $user->getPassword();

            if ($bcrypt->verify($this->password, $passwordHash)) {
                // Great! The password hash matches. Return user identity (email) to be
                // saved in session for later use.
                return new Result(
                    Result::SUCCESS,
                    $this->email,
                    ['Authenticated successfully.']);
            }else{
                return new Result(
                    Result::FAILURE_CREDENTIAL_INVALID,
                    null,
                    ['Invalid credentials.']);
            }

        }

    }

}