<?php

/*
 * This file is part of the TJ-SIF 2016 project.
 *
 * (c) toconuts <toconuts@google.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Entity;

use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\Organization;

class OrganizationRepository extends EntityRepository
{   
   
    public function findAllWithoutMe(Organization $organization)
    {        
        $em = $this->getEntityManager();
        $query = $em->createQuery(
            'SELECT o
            FROM AppBundle:Organization o
            WHERE o.id != :id'
        )->setParameter('id', $organization->getId());
        return $query;
    }
    
}
