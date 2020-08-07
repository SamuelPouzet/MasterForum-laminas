<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 07/08/2020
 * Time: 13:06
 */

namespace User\Repository;


use Doctrine\ORM\EntityRepository;
use User\Entity\Log;
use User\Entity\User;
use User\Module;

class LogRepository extends EntityRepository
{

    public function getConnectedUsers():array
    {
        $now = new \DateTime();
        $interval = new \DateInterval("PT15M");
        $now = $now->sub($interval);

        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select("U");

        $qb->from(User::class, 'U');
        $qb->join(Log::class, 'L', "WITH", "L.user = U");
        $qb->where("L.date > :limitDate");
        $qb->andWhere("U.forum_id = :forumId");
        $qb->setParameter("limitDate", $now);
        $qb->setParameter("forumId", Module::getForumId());

        return $qb->getQuery()->getResult();
    }

}