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
use Application\Entity\ForumTopic;
use Doctrine\ORM\EntityManager;
use User\Entity\User;
use User\Module;
use User\Service\AuthenticationService;

class ForumTopicManager
{
    protected $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function add(array $data):void
    {
        $topic = new ForumTopic();

        $forum = $this->entityManager->getRepository(Forum::class)->find(Module::getForumId());

        if(!$forum){
            throw new \Exception('forum inexistant');
        }

        $topic->setTitle($data['title']);

        $topic->setCatchphrase($data['catchphrase']);

        $category = $this->entityManager->getRepository(ForumSubject::class)->find((int)$data['subject_id']);
        $topic->setSubject($category);

        $topic->setDateCreated(new \DateTime());

        $topic->setStatus($data['status']);

        $this->entityManager->persist($topic);
        $this->entityManager->flush();
    }

    public function update(ForumTopic $topic, array $data):void
    {

        if(isset($data['title']) && $topic->getTitle() !== $data['email']){
            $topic->setTitle($data['title']);
        }

        if(isset($data['catchphrase']) && $topic->getCatchphrase() !== $data['catchphrase']){
            $topic->setCatchphrase($data['catchphrase']);
        }

        if(isset($data['subject_id']) && $topic->getSubjectId() !== $data['subject_id']){
            $subject = $this->entityManager->getRepository(ForumCategory::class)->find((int)$data['subject_id']);
            $topic->setSubject($subject);
        }


        if(isset($data['status']) && $topic->getStatus() !== $data['status']){
            $topic->setStatus($data['status']);
        }


        $this->entityManager->persist($topic);
        $this->entityManager->flush();
    }
}