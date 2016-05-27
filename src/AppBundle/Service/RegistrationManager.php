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
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\ORM\EntityManager;
use AppBundle\Entity\User;
use AppBundle\Entity\Invitation;
use AppBundle\Service\Mailer;

/**
 * Model for Registration
 *
 * @author toconuts <toconuts@gmail.com>
 */
class RegistrationManager
{
    /**
     * Encoder
     * 
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    /**
     * Mailer
     * 
     * @var Mailer
     */
    private $mailer;

    /**
     * Entity Manager
     * 
     * @var EntityManager
     */
    private $entityManager;
    
    public function __construct(UserPasswordEncoderInterface $encoder,
                                EntityManager $entityManager,
                                Mailer $mailer)
    {
        $this->encoder = $encoder;
        $this->entityManager = $entityManager;
        $this->mailer = $mailer;
    }
    
    public function registerUser(User $user, $ticket)
    {
        $invitationRepository = $this->entityManager->getRepository('AppBundle:Invitation');
        // findInvitation($tiket)
        // checkTicket()
        $this->entityManager->persist($invitation);
        
        $password = $this->encoder->encodePassword($user, $user->getPlainPassword());
        $user->setPassword($password);
        
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        
        if (1/*email is changed*/)
            $this->mailer->sendVerificationMail($user);
        else
            $this->mailer->sendWelcomeMail($user);
    }
    
    public function updateUser(User $user)
    {
        if (1 /* email is changed */) {
            // required verification
            // getActivationkey and set to user
            $this->entityManager->persist($user);
            $this->entityManager->flush();
            // redirect
        }
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
    
    public function sendInvitation(Invitation $invitation)
    {
        $invitationRepository = $this->entityManager->getRepository('AppBundle:Invitation');
        
        // check dup.
        
        $invitationRepository->createInvitation($invitation);
        $this->mailer->sendInvitationMail($invitation);
    }
    
    public function resendInvitation(Invitation $invitation)
    {
        
    }
}
