<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 28/07/2020
 * Time: 20:39
 */

namespace Css\Service;


use Application\Entity\Forum;
use Css\Entity\CssKey;
use Css\Entity\CssValue;
use Doctrine\ORM\EntityManager;
use User\Module;

class CssManager
{

    protected $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function add(array $data):void
    {
        $entity = new CssKey();
        $entity->setHeader($data['header']);
        $forum = $this->entityManager->getRepository(Forum::class)->find(Module::getForumId());
        $entity->setForum($forum);

        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }

    public function addValue(array $data):void
    {
        $entity = new CssValue();
        $entity->setAttribute($data['attribute']);
        $entity->setValue($data['value']);
        $key = $this->entityManager->getRepository(CssKey::class)->find($data['key']);
        $entity->setKey($key);

        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }

    public function updValue(CssValue $value, array $data):void
    {
        $value->setAttribute($data['attribute']);
        $value->setValue($data['value']);
        $key = $this->entityManager->getRepository(CssKey::class)->find($data['key']);
        $value->setKey($key);

        $this->entityManager->persist($value);
        $this->entityManager->flush();
    }

    public function removeValue(CssValue $value):void
    {
        $this->entityManager->remove($value);
        $this->entityManager->flush();
    }

}