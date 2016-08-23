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
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Doctrine\ORM\EntityManager;
use AppBundle\Entity\User;
use AppBundle\Entity\Invitation;
use AppBundle\Entity\ResettingPassword;
use AppBundle\Service\Mailer;
use AppBundle\Service\KeyGenerator;
use AppBundle\Service\RoleManager;

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
    
    /**
     * Role Manager
     * 
     * @var type 
     */
    private $roleManager;
    
    public function __construct(UserPasswordEncoderInterface $encoder,
                                EntityManager $entityManager,
                                Mailer $mailer,
                                RoleManager $roleManager)
    {
        $this->encoder = $encoder;
        $this->entityManager = $entityManager;
        $this->mailer = $mailer;
        $this->roleManager = $roleManager;
    }
    
    public function registerUser(User $user, Invitation $invitation)
    {
        $invitation->setTicket(null);
        $password = $this->encoder->encodePassword($user, $user->getPlainPassword());
        $user->setPassword($password);

        $user = $this->roleManager->updateRoles($user);

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
    
    public function sendInvitation(Invitation $invitation)
    {
        $invitationRepository = $this->entityManager->getRepository('AppBundle:Invitation');
        $oldInvitation = $invitationRepository->findValidOneByEmail($invitation->getEmail());
        if ($oldInvitation) {
            $invitation->setTicket($oldInvitation->getTicket());
        } else {
            $invitation->setTicket($this->issueActivationKey());
        }
        
        $this->mailer->sendInvitationMail($invitation);
        
        $invitationRepository->createInvitation($invitation);
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
    
    /**
     * Request for resetting password
     * 
     * @param User $user
     * @throws \Exception
     */
    public function requestResettingPassword(User $user)
    {
        $resettingPwdRepository = $this->entityManager->getRepository('AppBundle:ResettingPassword');
        
        $resettingPwd = $resettingPwdRepository->findOneBy(array('user' => $user));
        if ($resettingPwd) {
            if ($resettingPwd->isPasswordRequestNonExpired()) {
                throw new \Exception("The password for this user has already been requested within the last 24 hours.");
            }
        
        } else {
            $resettingPwd = new ResettingPassword($user);
        }

        $resettingPwd->setConfirmationToken($this->issueActivationKey());
        $resettingPwd->setVerificationCode($this->generateRandStr());

        $this->mailer->sendResettingPasswordMail($resettingPwd);
        
        $this->entityManager->persist($resettingPwd);
        $this->entityManager->flush();
    }
    
    /**
     * Get the requested resetting password.
     * 
     * @param type $confirmationToken
     * @return boolean
     */
    public function getResettingPassword($confirmationToken)
    {
        $resettingPwdRepository = $this->entityManager->getRepository('AppBundle:ResettingPassword');
        $resettingPwd = $resettingPwdRepository->findOneBy(array('confirmationToken' => $confirmationToken));
        
        if ($resettingPwd && $resettingPwd->isPasswordRequestNonExpired()) {
            return $resettingPwd;
        }
        
        return null;
    }
    
    /**
     * Reset password.
     * 
     * @param ResettingPassword $resettingPwd
     */
    public function resetPassword(ResettingPassword $resettingPwd)
    {
        $user = $resettingPwd->getUser();
        $password = $this->encoder->encodePassword($user, $resettingPwd->getNewPassword());
        $user->setPassword($password);
        
        $resettingPwd->setConfirmationToken(null);
        $resettingPwd->setVerificationCode(null);
        $this->entityManager->flush();
    }
    
    /**
     * Generate rundam numbers.
     * 
     * @staticvar string $chars
     * @param integer $length
     * @return string
     */
    public function generateRandStr($length = 6)
    {
        static $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJLKMNOPQRSTUVWXYZ0123456789';
        
        $str = '';
        for ($i = 0; $i < $length; ++$i) {
            $str .= $chars[mt_rand(0, (mb_strlen($chars)-1))];
        }
        
        return $str;
    }
}
