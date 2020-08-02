<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 18/07/2020
 * Time: 08:12
 */

namespace Application\Service;


use Application\Entity\Forum;
use Doctrine\ORM\EntityManager;
use Laminas\Crypt\Password\Bcrypt;
use Laminas\Math\Rand;
use User\Entity\User;
use User\Service\AuthenticationService;

class SignManager
{

    protected $entityManager;

    protected $authenticationService;

    protected $mailerService;

    public function __construct(EntityManager $em, AuthenticationService $authenticationService, MailerService $mailerService)
    {
        $this->entityManager = $em;
        $this->authenticationService = $authenticationService;
        $this->mailerService = $mailerService;
    }

    public function add(Forum $forum, array $data):void
    {

        $entity = new User();
        $now = new \DateTime();

        $entity->setEmail($data['email']);
        $entity->setName($data['name']);
        $entity->setFirstName($data['firstName']);
        $entity->setAlias($data['alias']);
        $entity->setPassword( $this->authenticationService->PasswordHash($data['password']));
        $entity->setDateCreated($now);
        $entity->setForum($forum);
        $entity->setStatus(User::STATUS_ACTIVE);

        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }

    public function resetPassword(User $user):void
    {
        $now = new \DateTime();
        $token = Rand::getString(32, '0123456789abcdefghijklmnopqrstuvwxyz', true);
        $bcrypt = new Bcrypt();
        $token = $bcrypt->create($token);

        $user->setPasswordResetToken($token);
        $user->setPasswordResetTokenCreationDate($now);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $this->mailerService->sendPassResetMail($user);
    }

    public function updateResettedPassword(string $password, User $user):void
    {
        $user->setPassword( $this->authenticationService->PasswordHash($password));
        $user->setPasswordResetToken(null);
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }

}