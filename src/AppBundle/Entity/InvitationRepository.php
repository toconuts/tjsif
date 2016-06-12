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
   
    public function findByTicket($ticket)
    {
        return $this->createQueryBuilder('i')
            ->where('i.ticket = :ticket')
            ->setParameter('ticket', $ticket)
            ->getQuery()
            ->getOneOrNullResult();
    }
    
    public function findAllByEmail($email)
    {
        return $this->createQueryBuilder('i')
            ->where('i.email = :email')
            ->setParameter('email', $email)
            ->getQuery()
            ->getResult();
    }
    
    public function createInvitation(Invitation $invitation)
    {
        $invitations = $this->findAllByEmail($invitation->getEmail());

        foreach ($invitations as $oldInvitation) {
            $ticket = $oldInvitation->getTicket();
            if (!empty($ticket)) {
                $invitation->setTicket($ticket);
                $oldInvitation->setTicket(null);
            }
        }
        
        $em = $this->getEntityManager();
        $em->persist($invitation);
        $em->flush();
    }
}
