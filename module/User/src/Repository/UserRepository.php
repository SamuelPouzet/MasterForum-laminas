<?php
namespace User\Repository;

use Doctrine\ORM\EntityRepository;
use User\Entity\User;
use User\Module;

/**
 * This is the custom repository class for User entity.
 */
class UserRepository extends EntityRepository
{
    /**
     * Retrieves all users in descending dateCreated order.
     * @return Query
     */
    public function findAllUsers()
    {
        $entityManager = $this->getEntityManager();
        
        $queryBuilder = $entityManager->createQueryBuilder();
        
        $queryBuilder->select('u')
            ->from(User::class, 'u')
            ->orderBy('u.dateCreated', 'DESC');
        
        return $queryBuilder->getQuery();
    }

    public function findAllUsersInForum():array
    {
        $entityManager = $this->getEntityManager();

        $queryBuilder = $entityManager->createQueryBuilder();

        $queryBuilder->select('u')
            ->from(User::class, 'u')
            ->where('u.forum_id = :id')
            ->orderBy('u.dateCreated', 'DESC')
            ->setParameter('id', Module::getForumId());

        return $queryBuilder->getQuery()->getResult();
    }
}