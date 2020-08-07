<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 07/08/2020
 * Time: 07:58
 */

namespace User\Service;


use Doctrine\ORM\EntityManager;
use User\Entity\Log;
use User\Entity\User;

class LogManager
{

    protected $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function log(User $user)
    {
        if(! $userInstance = $this->entityManager->getRepository(Log::class)->findOneBy(['user'=>$user ])){
            $userInstance = new Log();
            $userInstance->setUser($user);
        }

        $userInstance->setDate(new \DateTime());

        $this->entityManager->persist($userInstance);
        $this->entityManager->flush();

    }

}