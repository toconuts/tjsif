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
use AppBundle\Entity\Activity;

class ActivityRepository extends EntityRepository
{   
   
    public function findAllOrderedByStartDatetimeAndEndtime()
    {        
        $em = $this->getEntityManager();
        $query = $em->createQuery(
            'SELECT a
            FROM AppBundle:Activity a
            ORDER BY a.starttime ASC,
            a.endtime ASC');     
        return $query->getResult();
    }
    
}
