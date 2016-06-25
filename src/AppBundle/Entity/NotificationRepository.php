<?php

namespace AppBundle\Entity;

/**
 * NotificationRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class NotificationRepository extends \Doctrine\ORM\EntityRepository
{
    public function getLatestNotifications($limit = 10)
    {
        $qb = $this->createQueryBuilder('n')
                    ->select('n')
                    ->addOrderBy('n.id', 'DESC');

        if (false === is_null($limit))
            $qb->setMaxResults($limit);

        return $qb->getQuery()
                  ->getResult();
    }
}
