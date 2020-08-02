<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 25/07/2020
 * Time: 16:43
 */

namespace Application\Service\Messenger;


use Application\Entity\Messenger\Responses;
use Doctrine\ORM\EntityManager;

class ResponseManager
{

    protected $entityManager;



    public function __construct(EntityManager $em)
    {
        $this->entityManager = $em;

    }

    public function add(array $data):void
    {
        $entity = new Responses();
        $now = new \DateTime();

        $entity->setContent($data['content']);
        $entity->setDateCreation($now);
        $entity->setAuthor($data['user']);
        $entity->setMessage($data['message']);

        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }

}