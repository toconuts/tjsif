<?php

namespace AppBundle\Entity;

use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityRepository;
use AppBundle\Utils\ChoiceList\AccountChoiceLoader;

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
        $organizations = $this->getEntityManager()
                ->getRepository('AppBundle:Organization')->findBy([], ['id' => 'ASC']);
        
        foreach ($organizations as $organization) {
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
    
    public function findAllSortedByOrganization()
    {
        return $this->createQueryBuilder('u')
            ->leftJoin('u.organization', 'o')
            ->addSelect('o.type+0 as HIDDEN int_type')
            ->where('u.isActive = :aid', 'o.isActive = :aid','u.type != :type1', 'u.type != :type2')
            ->addOrderBy('int_type', 'ASC')
            ->addOrderBy('u.organization', 'ASC')
            ->addOrderBy('u.occupation', 'ASC')
            ->addOrderBy('u.type', 'ASC')
            ->setParameter('aid', 1)
            ->setParameter('type1', AccountChoiceLoader::ACCOUNT_CONTACT_PERSON_NA_ID)
            ->setParameter('type2', AccountChoiceLoader::ACCOUNT_OBSERVER_ID)
            ->getQuery()
            ->getResult();
    }
    
    public function findByOccupationSortedByOrganization($id)
    {
        return $this->createQueryBuilder('u')
            ->leftJoin('u.organization', 'o')
            ->addSelect('o.type+0 as HIDDEN int_type')
            ->where('u.occupation = :id', 'u.isActive = :aid', 'o.isActive = :aid', 'u.type != :type1', 'u.type != :type2')
            ->addOrderBy('int_type', 'ASC')
            ->addOrderBy('u.organization', 'ASC')
            ->addOrderBy('u.occupation', 'ASC')
            ->addOrderBy('u.type', 'ASC')
            ->setParameter('aid', 1)
            ->setParameter('id', $id)
            ->setParameter('type1', AccountChoiceLoader::ACCOUNT_CONTACT_PERSON_NA_ID)
            ->setParameter('type2', AccountChoiceLoader::ACCOUNT_OBSERVER_ID)
            ->getQuery()
            ->getResult();
    }
    
    public function findExcluededByOccupationSortedByOrganization($id)
    {
        return $this->createQueryBuilder('u')
            ->leftJoin('u.organization', 'o')
            ->addSelect('o.type+0 as HIDDEN int_type')
            ->where('u.occupation != :id', 'u.isActive = :aid', 'o.isActive = :aid', 'u.type != :type1', 'u.type != :type2')
            ->addOrderBy('int_type', 'ASC')
            ->addOrderBy('u.organization', 'ASC')
            ->addOrderBy('u.occupation', 'ASC')
            ->addOrderBy('u.type', 'ASC')
            ->setParameter('aid', 1)
            ->setParameter('id', $id)
            ->setParameter('type1', AccountChoiceLoader::ACCOUNT_CONTACT_PERSON_NA_ID)
            ->setParameter('type2', AccountChoiceLoader::ACCOUNT_OBSERVER_ID)
            ->getQuery()
            ->getResult();
    }
}
