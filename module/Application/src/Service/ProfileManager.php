<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 16/07/2020
 * Time: 19:34
 */

namespace Application\Service;


use Doctrine\ORM\EntityManager;
use User\Entity\User;
use User\Entity\UserProfile;

class ProfileManager
{

    protected $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    public function add(User $user, array $data):void
    {
        $profile = new UserProfile();

        $profile->setSignature($data['signature']);
        $profile->setDescription($data['description']);
        $profile->setUser($user);

        $this->entityManager->persist($profile);
        $this->entityManager->flush();

    }

    public function update(UserProfile $userProfile, array $data):void
    {

        if( $userProfile->getSignature() != $data['signature']){
            $userProfile->setSignature($data['signature']);
        }

        if($userProfile->getDescription() != $data['description']){
            $userProfile->setDescription($data['description']);
        }


        $this->entityManager->persist($userProfile);
        $this->entityManager->flush();

    }

}