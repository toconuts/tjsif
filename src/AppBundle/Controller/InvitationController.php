<?php

/*
 * This file is part of the TJ-SIF 2016 project.
 *
 * (c) toconuts <toconuts@google.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Form\UserType;
use AppBundle\Form\InvitationType;
use AppBundle\Entity\User;
use AppBundle\Entity\Invitation;

/**
 * Description of InvitationController
 *
 * @author toconuts <toconuts@gmail.com>
 * 
 * @Route("/admin")
 */
class InvitationController extends Controller
{    
    /**
     * @Route("/invitation", name="admin_invitation")
     */
    public function inviteAction()
    {
        
        $invitation = new Invitation($this->getUser());
        $form = $this->createForm(InvitationType::class, $invitation);
        
        if ($form->isSubmitted() && $form->isValid()) {
            
            // check duplicate            
            // create activation key
            //$this->get('app.registration_manager')->sendInvitation($invitation);
            
            $message = \Swift_Message::newInstance()
                ->setSubject('The invitation to TJ-SIF2016 Official Website')
                ->setFrom('tjsif2016@gmail.com')
                ->setTo('admin@example.com')
                ->setBody(
                    $this->renderView(
                        'mail/invitation.txt.twig',
                        ['invitation' => $invitation]
                    )
                );
            
            $this->get('mailer')->send($message);
            
            return $this->redirect('app_invite_complete');
        }
        
        return $this->render('registration/inbitation.html.twig',
            ['form' => $form->createView()]
        );
    }
}
