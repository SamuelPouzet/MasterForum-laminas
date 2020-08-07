<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 02/08/2020
 * Time: 20:36
 */

namespace Application\Service;


use Application\Entity\ForumCustomResponse;
use Application\Entity\ForumResponse;
use Application\Entity\ForumSubject;
use Application\Entity\ForumTopic;
use Doctrine\ORM\EntityManager;
use User\Entity\User;

class TopicManager
{
    protected $entityManager;

    public  function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function add(array $data, ForumSubject $subject, User $author):void
    {
        $topic = new ForumTopic();
        $topic->setSubject($subject);
        $topic->setType($subject->getType());
        $topic->setCatchphrase($data['catchphrase']);
        $topic->setTitle($data['title']);
        $topic->setStatus(1);
        $topic->setDateCreated(new \DateTime());

        if($data['custom'] && $data['custom'] != "null" ){
            $customResponse = new ForumCustomResponse();
            $customResponse->setTopic($topic);
            $customResponse->setDateCreated(new \DateTime());
            $customResponse->setContent($data['custom']);
            $customResponse->setAuthor($author);

            $this->entityManager->persist($customResponse);
            $this->entityManager->flush();
        }else{
            $normalResponse = new ForumResponse();
            $normalResponse->setAuthor($author);
            $normalResponse->setDateCreated(new \DateTime());
            $normalResponse->setContent($data['normal']);
            $normalResponse->setTopic($topic);
            $this->entityManager->persist($normalResponse);
            $this->entityManager->flush();
        }

    }

}