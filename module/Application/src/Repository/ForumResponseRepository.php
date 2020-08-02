<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 11/07/2020
 * Time: 09:49
 */

namespace Application\Repository;


use Application\Entity\Forum;
use Application\Entity\ForumCategory;
use Application\Entity\ForumResponse;
use Application\Entity\ForumSubject;
use Application\Entity\ForumTopic;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use User\Module;

class ForumResponseRepository extends EntityRepository
{

    public function searchResponsesInForum():array
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('FR');
        $qb->from(ForumResponse::class, 'FR');
        $qb->join(ForumTopic::class, "FT", 'WITH', "FT.id=FR.topic_id");
        $qb->join(ForumSubject::class, 'FS', 'WITH', 'FS.id=FT.subject_id');
        $qb->join(ForumCategory::class, 'FC', 'WITH', 'FC.id=FS.category_id and FC.forum_id=:forumId');

        $qb->setParameter('forumId', Module::getForumId());
        return $qb->getQuery()->getResult();
    }

    public function searchResponseInForum(int $id):ForumResponse
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('FR');
        $qb->from(ForumResponse::class, 'FR');
        $qb->join(ForumTopic::class, "FT", 'WITH', "FT.id=FR.topic_id");
        $qb->join(ForumSubject::class, 'FS', 'WITH', 'FS.id=FT.subject_id');
        $qb->join(ForumCategory::class, 'FC', 'WITH', 'FC.id=FS.category_id and FC.forum_id=:forumId');
        $qb->where('FR.id = :id');

        $qb->setParameter('forumId', Module::getForumId());
        $qb->setParameter('id', $id);
        return $qb->getQuery()->getOneOrNullResult();
    }

    public function searchElementInForum(string $element):array
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('FR');
        $qb->from(ForumResponse::class, 'FR');
        $qb->join(ForumTopic::class, "FT", 'WITH', "FT.id=FR.topic_id");
        $qb->join(ForumSubject::class, 'FS', 'WITH', 'FS.id=FT.subject_id and FS.forum_id=?1');
        $qb->where("FR.content LIKE ?2");
        $qb->setParameter(1, Module::getForumId());
        $qb->setParameter(2, "%" . $element . "%");

        return $qb->getQuery()->getResult();

    }

    public function getQueryForPagination(ForumTopic $topic):Query
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('FR');
        $qb->from(ForumResponse::class, 'FR');
        $qb->join(ForumTopic::class, "FT", 'WITH', "FT.id=FR.topic_id");
        $qb->where("FT.id LIKE ?1");
        $qb->setParameter(1, $topic->getId());
        $qb->orderBy('FR.date_created', 'asc');

        return $qb->getQuery();
    }


}