<?php

namespace AppBundle\Entity;

use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityRepository;

/*
 * This file is part of the TJ-SIF 2016 project.
 *
 * (c) toconuts <toconuts@google.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class UserRepository extends EntityRepository implements UserLoaderInterface
{
    /**
     * @inheritdoc
     */
    public function loadUserByUsername($username)
    {
        return $this->createQueryBuilder('u')
            ->where('u.email = :email')
            ->setParameter('email', $username)
            ->getQuery()
            ->getOneOrNullResult();
    }
    
    public function findUserSortedByOrganization()
    {
        $list = array();
        $organizations = $this->getEntityManager()->getRepository('AppBundle:Organization')->findAll();
        
        foreach ($organizations as $organization) {
            /*//$list[$organization->getShortname()]
            //        = $this->createQueryBuilder('u, CAST(u.occupation AS SIGNED) AS occupation_id')
            $query = $this->createQueryBuilder('u CAST(u.occupation AS SIGNED) AS occupation_id')
            //$query = $this->createQueryBuilder('u')        
                    ->innerJoin('u.organization', 'o')
                    ->where('o.id = :id')
                    ->orderBy('u.isActive', 'ASC')
                    ->orderBy('u.type', 'ASC')
                    ->orderBy('u.occupation', 'ASC')
                    ->setParameter('id', $organization->getId())
                    ->getQuery();
//                    ->getMaxResults();
            $list[$organization->getShortname()] = $query->getResult();*/
/*            $list[$organization->getShortname()] = $this->getEntityManager()
                ->createQuery(
                    'SELECT u FROM AppBundle:User u
                    INNER JOIN u.organization o
                    WHERE o.id = :id
                    ORDER BY u.isActive DESC,
                             u.occupation ASC,
                             u.type ASC'
                )->setParameter('id', $organization->getId())
                ->getResult();*/
            
//TODO: add order by occupation field 
            $list[$organization->getShortname()] = $this->getEntityManager()
                ->createQuery(
                    'SELECT u FROM AppBundle:User u
                    INNER JOIN u.organization o
                    WHERE o.id = :id
                    ORDER BY cast(u.occupation as Integer) ASC,
                             u.type ASC,
                             u.isActive DESC'
                )->setParameter('id', $organization->getId())
                ->getResult();
        }
        return $list;
    }
}
