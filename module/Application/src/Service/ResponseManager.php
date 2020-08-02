<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 11/07/2020
 * Time: 11:26
 */

namespace Application\Service;


use Application\Entity\Forum;
use Application\Entity\ForumResponse;
use Application\Entity\ForumTopic;
use Doctrine\ORM\EntityManager;

class ResponseManager
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * ResponseManager constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function add(array $data, ForumTopic $topic):ForumResponse
    {
        $entity = new ForumResponse();
        $entity->setTopic($topic);
        $entity->setDateCreated(new \DateTime());
        $entity->setContent($data['content']);
        $entity->setAuthor($data['user']);

        $this->entityManager->persist($entity);
        $this->entityManager->flush();

        return $entity;
    }

}