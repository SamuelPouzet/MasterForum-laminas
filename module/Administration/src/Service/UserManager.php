<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 26/07/2020
 * Time: 12:35
 */

namespace Administration\Service;


use Application\Entity\Forum;
use Doctrine\ORM\EntityManager;
use User\Entity\User;
use User\Module;
use User\Service\AuthenticationService;

class UserManager
{
    protected $entityManager;
    protected $authenticationService;

    public function __construct(EntityManager $entityManager, AuthenticationService $authenticationService)
    {
        $this->entityManager = $entityManager;
        $this->authenticationService = $authenticationService;
    }

    public function add(array $data)
    {
        $user = new User();

        $forum = $this->entityManager->getRepository(Forum::class)->find(Module::getForumId());

        if(!$forum){
            throw new \Exception('forum inexistant');
        }

        $user->setEmail($data['email']);

        $user->setName($data['firstName']);

        $user->setFirstName($data['name']);

        $user->setDateCreated(new \DateTime());

        $user->setForum($forum);

        $user->setAlias($data['alias']);

        $user->setStatus($data['status']);

        //ON crée un MDP arbitraire, et on envoie un token de connexion au mail enregistré pour que l'utilisateur crée son mot de passe.
        //Ainsi, personne d'autre que l'utilisateur nouvellement créé n'accede à son compte
        //@todo envoyer mail

        $password = uniqid();

        $hash = $this->authenticationService->PasswordHash($password);

        $user->setPassword($hash);

        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }

    public function update(User $user, array $data):void
    {

        if(isset($data['email']) && $user->getEmail() !== $data['email']){
            $user->setEmail($data['email']);
        }

        if(isset($data['firstName']) && $user->getFirstName() !== $data['firstName']){
            $user->setName($data['firstName']);
        }

        if(isset($data['name']) && $user->getName() !== $data['name']){
            $user->setFirstName($data['name']);
        }

        if(isset($data['alias']) && $user->getAlias() !== $data['alias']){
            $user->setAlias($data['alias']);
        }

        if(isset($data['status']) && $user->getStatus() !== $data['status']){
            $user->setStatus($data['status']);
        }

        if(isset($data['new_password'])){

            $hash = $this->authenticationService->PasswordHash($data['new_password']);

            $user->setPassword($hash);
        }

        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}