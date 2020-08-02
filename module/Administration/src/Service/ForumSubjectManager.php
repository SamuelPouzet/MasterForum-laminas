<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 26/07/2020
 * Time: 12:35
 */

namespace Administration\Service;


use Application\Entity\Forum;
use Application\Entity\ForumCategory;
use Application\Entity\ForumSubject;
use Doctrine\ORM\EntityManager;
use User\Entity\User;
use User\Module;
use User\Service\AuthenticationService;

class ForumSubjectManager
{
    protected $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function add(array $data)
    {
        $user = new ForumSubject();

        $forum = $this->entityManager->getRepository(Forum::class)->find(Module::getForumId());

        if(!$forum){
            throw new \Exception('forum inexistant');
        }

        $user->setTitle($data['title']);

        $user->setCatchphrase($data['catchphrase']);

        $category = $this->entityManager->getRepository(ForumCategory::class)->find((int)$data['category_id']);
        $user->setCategory($category);

        $user->setDateCreated(new \DateTime());

        $user->setType($data['type']);

        $user->setStatus($data['status']);

        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }

    public function update(ForumSubject $user, array $data):void
    {

        if(isset($data['title']) && $user->getTitle() !== $data['email']){
            $user->setTitle($data['title']);
        }

        if(isset($data['catchphrase']) && $user->getCatchphrase() !== $data['catchphrase']){
            $user->setCatchphrase($data['catchphrase']);
        }

        if(isset($data['category_id']) && $user->getCategoryId() !== $data['category_id']){
            $category = $this->entityManager->getRepository(ForumCategory::class)->find((int)$data['category_id']);
            $user->setCategory($category);
        }

        if(isset($data['type']) && $user->getType() !== $data['type']){
            $user->setType($data['type']);
        }

        if(isset($data['status']) && $user->getStatus() !== $data['status']){
            $user->setStatus($data['status']);
        }

        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}