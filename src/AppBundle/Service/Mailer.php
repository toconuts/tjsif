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

use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use AppBundle\Entity\User;
use AppBundle\Entity\Invitation;
use AppBundle\Entity\ResettingPassword;

/**
 * Description of Mailer
 *
 * @author toconuts <toconuts@gmail.com>
 */
class Mailer
{
    /**
     * Mailer
     * 
     * @var \Swift_Mailer
     */
    private $mailer;
    
    /**
     * Twig EngineInterface
     * 
     * @var EngineInterface 
     */
    private $templating;
    
    public function __construct(\Swift_Mailer $mailer, EngineInterface $templating)
    {
        $this->mailer = $mailer;
        $this->templating = $templating;
    }
    
    public function sendVerificationMail(User $user)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject('Inportant: verify your email to use TJ-SIF2016 Official Website')
            ->setFrom('tjsif2016@gmail.com')
            ->setTo($user->getEmail())
            ->setBody(
            $this->templating->render(
                    'mail/verification.txt.twig',
                    ['user' => $user]
                )
            );
        
        return $this->mailer->send($message);
    }
    
    public function sendInvitationMail(Invitation $invitation)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject('The invitation to TJ-SIF2016 Official Website')
            ->setFrom('tjsif2016@gmail.com')
            ->setTo($invitation->getEmail())
            ->setBody(
            $this->templating->render(
                    'mail/invitation.txt.twig',
                    ['invitation' => $invitation]
                )
            );
        
        return $this->mailer->send($message);
    }
    
    public function sendResettingPasswordMail(ResettingPassword $resettingPassword)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject('Inportant: Reset Password for TJ-SIF2016 member site account')
            ->setFrom('tjsif2016@gmail.com')
            ->setTo($resettingPassword->getUser()->getEmail())
            ->setBody(
            $this->templating->render(
                    'mail/resetting_password.txt.twig',
                    [
                        'user' => $resettingPassword->getUser(),
                        'resetting_password' => $resettingPassword,
                    ]
                )
            );
        
        return $this->mailer->send($message);
    }
}
