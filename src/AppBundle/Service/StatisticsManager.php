<?php

/*
 * This file is part of the TJ-SIF 2016 project.
 *
 * (c) toconuts <toconuts@google.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Service;

use Doctrine\ORM\EntityManager;
use AppBundle\Utils\ChoiceList\AccountChoiceLoader;
use AppBundle\Utils\ChoiceList\OrganizationChoiceLoader;

/**
 * Description of StatisticsManager
 *
 * @author toconuts <toconuts@gmail.com>
 */
class StatisticsManager
{
    /**
     * Entity Manager
     * 
     * @var EntityManager
     */
    private $entityManager;
    
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    public function getRegistrationStatistics()
    {
        $qb = $this->entityManager->createQueryBuilder();
        $qb->select('o, SUM(CASE WHEN u.occupation=1    AND u.isActive=true AND u.type !=:type1 AND u.type !=:type2 THEN 1 ELSE 0 END),
                        SUM(CASE WHEN u.occupation=2    AND u.isActive=true AND u.type !=:type1 AND u.type !=:type2 THEN 1 ELSE 0 END),
                        SUM(CASE WHEN u.occupation=4    AND u.isActive=true AND u.type !=:type1 AND u.type !=:type2 THEN 1 ELSE 0 END),
                        SUM(CASE WHEN u.occupation=8    AND u.isActive=true AND u.type !=:type1 AND u.type !=:type2 THEN 1 ELSE 0 END),
                        SUM(CASE WHEN u.occupation=16   AND u.isActive=true AND u.type !=:type1 AND u.type !=:type2 THEN 1 ELSE 0 END),
                        SUM(CASE WHEN u.occupation=32   AND u.isActive=true AND u.type !=:type1 AND u.type !=:type2 THEN 1 ELSE 0 END),
                        SUM(CASE WHEN u.occupation=1024 AND u.isActive=true AND u.type !=:type1 AND u.type !=:type2 THEN 1 ELSE 0 END),
                        SUM(CASE WHEN u.isActive=true   AND u.type !=:type1 AND u.type !=:type2  THEN 1 ELSE 0 END)')
            ->addSelect('o.type+0 as HIDDEN int_type')
            ->from('AppBundle:Organization', 'o')
            ->where('o.isActive=true')
            ->addOrderBy('int_type', 'ASC')
            ->addOrderBy('o.id', 'ASC')
            ->leftJoin('o.users', 'u')
            ->groupBy('o.id')
            ->setParameter('type1', AccountChoiceLoader::ACCOUNT_CONTACT_PERSON_NA_ID)
            ->setParameter('type2', AccountChoiceLoader::ACCOUNT_OBSERVER_ID)
        ;
        return $qb->getQuery()->getResult();
    }
    
    public function getNumberOfProjectStatistics()
    {
        $qb = $this->entityManager->createQueryBuilder();
        $qb->select('o, SUM(CASE WHEN p.category=1 AND p.isActive=true THEN 1 ELSE 0 END),
                        SUM(CASE WHEN p.category=2 AND p.isActive=true THEN 1 ELSE 0 END),
                        SUM(CASE WHEN p.category=3 AND p.isActive=true THEN 1 ELSE 0 END),
                        SUM(CASE WHEN p.category=4 AND p.isActive=true THEN 1 ELSE 0 END),
                        SUM(CASE WHEN p.category=5 AND p.isActive=true THEN 1 ELSE 0 END),
                        SUM(CASE WHEN p.category=6 AND p.isActive=true THEN 1 ELSE 0 END),
                        SUM(CASE WHEN p.category=7 AND p.isActive=true THEN 1 ELSE 0 END),
                        SUM(CASE WHEN p.isActive=true THEN 1 ELSE 0 END)')
            ->addSelect('o.type+0 as HIDDEN int_type')
            ->from('AppBundle:Organization', 'o')
            ->where('o.isActive=true AND (o.type = :type1 OR o.type = :type2 OR o.type = :type3 OR o.type = :type4)')
            ->leftJoin('o.projects', 'p')
            ->addOrderBy('int_type', 'ASC')
            ->addOrderBy('o.id', 'ASC')
            ->groupBy('o.id')
            ->setParameter('type1', OrganizationChoiceLoader::ORGANIZATION_FORM_12_PCSHS_ID)
            ->setParameter('type2', OrganizationChoiceLoader::ORGANIZATION_FORM_SSHS_JAPAN_ID)
            ->setParameter('type3', OrganizationChoiceLoader::ORGANIZATION_FORM_SISTER_THAI_ID)
            ->setParameter('type4', OrganizationChoiceLoader::ORGANIZATION_FORM_SHS_THAI_ID)
        ;
        return $qb->getQuery()->getResult();
    }

    
    public function getNumberOfProjectCategoryGroupByOrganization()
    {
        $qb = $this->entityManager->createQueryBuilder();
        $qb->select('o, SUM(CASE WHEN p.category=1 AND p.isActive=true THEN 1 ELSE 0 END),
                        SUM(CASE WHEN p.category=2 AND p.isActive=true THEN 1 ELSE 0 END),
                        SUM(CASE WHEN p.category=3 AND p.isActive=true THEN 1 ELSE 0 END),
                        SUM(CASE WHEN p.category=4 AND p.isActive=true THEN 1 ELSE 0 END),
                        SUM(CASE WHEN p.category=5 AND p.isActive=true THEN 1 ELSE 0 END),
                        SUM(CASE WHEN p.category=6 AND p.isActive=true THEN 1 ELSE 0 END),
                        SUM(CASE WHEN p.category=7 AND p.isActive=true THEN 1 ELSE 0 END),
                        SUM(CASE WHEN p.isActive=true THEN 1 ELSE 0 END)')
            ->from('AppBundle:Organization', 'o')
            ->leftJoin('o.projects', 'p')
            ->where('o.type = 1 OR o.type = 2 OR o.type = 3')
            ->groupBy('o.id')
        ;
        return $qb->getQuery()->getResult();
    }
        
    public function getNumberOfProjectTypeGroupByOrganization()
    {
        $qb = $this->entityManager->createQueryBuilder();
        $qb->select('o, SUM(CASE WHEN p.style=1 AND p.isActive=true THEN 1 ELSE 0 END),
                        SUM(CASE WHEN p.style=2 AND p.isActive=true THEN 1 ELSE 0 END),
                        SUM(CASE WHEN p.isActive=true THEN 1 ELSE 0 END)')
            ->from('AppBundle:Organization', 'o')
            ->leftJoin('o.projects', 'p')
            ->where('o.type = 1 OR o.type = 2 OR o.type = 3')
            ->groupBy('o.id')
        ;
        return $qb->getQuery()->getResult();
    }
    
    public function getNumberOfProjectTypeGroupByOrganizationType()
    {
        $qb = $this->entityManager->createQueryBuilder();
        $qb->select('o.type, COUNT(DISTINCT o.id), SUM(CASE WHEN p.isActive=true THEN 1 ELSE 0 END)')
            ->from('AppBundle:Organization', 'o')
            ->leftJoin('o.projects', 'p')
            ->where('o.type = 1 OR o.type = 2 OR o.type = 3')
            ->groupBy('o.type')
        ;
        return $qb->getQuery()->getResult();
    }
}
