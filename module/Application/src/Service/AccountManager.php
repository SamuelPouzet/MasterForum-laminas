<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 17/07/2020
 * Time: 12:47
 */

namespace Application\Service;


use Doctrine\ORM\EntityManager;
use User\Entity\User;

class AccountManager
{

    protected $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function update(User $user, array $data)
    {
        if($user->getAlias() != $data['alias']){
            //Alias cant't be changed possible security break
            throw new \Exception('trying to change Alias');
        }

        if($user->getName() != $data['name']){
            $user->setName($data['name']);
        }

        if($user->getFirstName() != $data['firstName']){
            $user->setFirstName($data['firstName']);
        }

        if($user->getEmail() != $data['email']) {
            $user->setEmail($data['email']);
        }

        $this->entityManager->persist($user);
        $this->entityManager->flush();

    }

}