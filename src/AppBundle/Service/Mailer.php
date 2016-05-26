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
        
    }
    
    public function sendWelcomeMail(User $user)
    {
        
    }
    
    public function sendInvitationMail(Invitation $invitation)
    {
        
    }
}
