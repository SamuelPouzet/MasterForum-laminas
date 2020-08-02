<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 11/07/2020
 * Time: 10:34
 */

namespace Application\Repository;


use Application\Entity\Forum;
use Application\Entity\ForumCategory;
use Application\Entity\ForumSubject;
use Application\Entity\ForumTopic;
use Doctrine\ORM\EntityRepository;
use User\Module;

class ForumTopicRepository extends EntityRepository
{

    public function findTopicInForum(int $id_topic):ForumTopic
    {

        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb->select("T");
        $qb->from(ForumTopic::class, 'T');
        $qb->innerJoin(ForumSubject::class, 'FS', 'WITH', "FS.id = T.subject_id");
        $qb->innerJoin(ForumCategory::class, 'FC', 'WITH', "FC.id = FS.category_id");
        $qb->innerJoin(Forum::class, 'F', 'WITH', "F.id = FC.forum_id");
        $qb->where('T.id = ?1');
        $qb->andWhere('F.id = ?2');
        $qb->setParameter(1, $id_topic);
        $qb->setParameter(2, Module::getForumId());
        $qb->setMaxResults(1);

        return $qb->getQuery()->getOneOrNullResult();

    }

    public function findTopicsInForum():array
    {

        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb->select("T");
        $qb->from(ForumTopic::class, 'T');
        $qb->innerJoin(ForumSubject::class, 'FS', 'WITH', "FS.id = T.subject_id");
        $qb->innerJoin(ForumCategory::class, 'FC', 'WITH', "FC.id = FS.category_id");
        $qb->innerJoin(Forum::class, 'F', 'WITH', "F.id = FC.forum_id");
        $qb->where('F.id = :forumId');
        $qb->setParameter('forumId', Module::getForumId());

        return $qb->getQuery()->getResult();

    }

}