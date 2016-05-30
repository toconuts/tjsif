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
use AppBundle\Service\KeyGenerator;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
    
    public function registerUser(User $user, Invitation $invitation)
    {
        $invitation->setTicket(null);
        $password = $this->encoder->encodePassword($user, $user->getPlainPassword());
        $user->setPassword($password);
        
//TODO: set role;
//TODO: set initial profile picture

        if ($this->isChangedEmail($user, $invitation)) {
            $user->setActivationKey($this->issueActivationKey());
            $user->setIsActive(false);
            $this->mailer->sendVerificationMail($user);
        }
        
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        
    }
    
    public function getUser($email)
    {
        $userRepository = $this->entityManager->getRepository('AppBundle:User');
        return $userRepository->loadUserByUsername($email);
    }
    
    public function updateUser(User $user)
    {
        
    }
    
    public function sendInvitation(Invitation $invitation)
    {
        $ticket = $this->issueActivationKey();
        $invitation->setTicket($ticket);

        $invitationRepository = $this->entityManager->getRepository('AppBundle:Invitation');
           
        $invitationRepository->createInvitation($invitation);
        $this->mailer->sendInvitationMail($invitation);
    }
    
    public function isChangedEmail(User $user, Invitation $invitation)
    {       
        return ($user->getEmail() == $invitation->getEmail()) ? false : true;
    }
    
    /**
     * Activate user.
     *
     * @param string $activationKey
     * @return User
     */
    public function activateUser($activationKey)
    {
        $userRepository = $this->entityManager->getRepository('AppBundle:User');
        
        $user = $userRepository->findOneBy(array('activationKey' => $activationKey));
        if (!$user) {
          return null;
        }

        $user->setActivationKey(null);
        $user->setIsActive(true);
        $this->entityManager->flush();

        return $user;
    }
    
    public function getInvitation($ticket)
    {
        $invitationRepository = $this->entityManager->getRepository('AppBundle:Invitation');
        return $invitationRepository->findByTicket($ticket);
    }
    
    /**
     * Issue activation key.
     *
     * @return string
     */
    protected function issueActivationKey()
    {
        $bytes = false;
        if (function_exists('openssl_random_pseudo_bytes')) {
            $bytes = openssl_random_pseudo_bytes(32, $strong);

            if (true !== $strong) {
                $bytes = false;
            }
        }

        if (false === $bytes) {
            $bytes = hash('sha256', uniqid(mt_rand(), true), true);
        }

        $key = base_convert(bin2hex($bytes), 16, 36);

        return $key;
    }
}
