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
use AppBundle\Entity\Invitation;

class InvitationRepository extends EntityRepository
{ 
    public function createInvitation(Invitation $invitation)
    {
        $this->updateInvitation($invitation);
    }
    
    public function updateInvitation(Invitation $invitation)
    {
        // search
        // if (exist) {
        // unactivate
        // }
        // 
        $em = $this->getEntityManager();
        $em->persist($invitation);
        $em->flush();
    }
}
