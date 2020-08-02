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
use Application\Entity\ForumSubject;
use Doctrine\ORM\EntityRepository;
use User\Module;

class ForumSubjectRepository extends EntityRepository
{

    public function findSubjectInForum(int $id_subject):?ForumSubject
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('FS');
        $qb->from(ForumSubject::class, 'FS');
        $qb->join(ForumCategory::class, 'FC', 'WITH', 'FC.id=FS.category_id');


        $qb->where('FC.forum_id = :idforum');
        $qb->andWhere('FS.id = :id');
        $qb->setParameter('idforum', Module::getForumId());
        $qb->setParameter('id', $id_subject);

        return $qb->getQuery()->getOneOrNullResult();
    }

    public function findSubjectsInForum(int $category = 0):array
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('FS');
        $qb->from(ForumSubject::class, 'FS');
        $qb->join(ForumCategory::class, 'FC', 'WITH', 'FC.id=FS.category_id');

        if($category > 0){
            $qb->where('FC.category_id = :idcategory');
            $qb->setParameter('idcategory', $category);
        }else{
            $qb->where('FC.forum_id = :idforum');
            $qb->setParameter('idforum', Module::getForumId());
        }

        return $qb->getQuery()->getResult();
    }

}