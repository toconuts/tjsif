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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Form\InvitationType;
use AppBundle\Entity\Invitation;

/**
 * Description of InvitationController
 *
 * @author toconuts <toconuts@gmail.com>
 * 
 * @Route("/member")
 */
class InvitationController extends Controller
{    
    /**
     * @Route("/invitation", name="member_invitation")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function inviteAction(Request $request)
    {
        
        $invitation = new Invitation($this->getUser());
        
        $form = $this->createForm(InvitationType::class, $invitation);
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $rm = $this->get('app.registration_manager');            
            if ($rm->getUser($invitation->getEmail())) {
                $this->addFlash(
                    'error',
                    'The invitation has already been sent to' . $invitation->getEmail()
                );
                $this->redirect('member_invitation');
            }

            $rm->sendInvitation($invitation);
            
            $this->addFlash(
                'success',
                'Sent the invitation to ' . $invitation->getEmail()
            );

            $this->redirect('member_invitation');
        }
        
        return $this->render('invitation/invite.html.twig',
            ['form' => $form->createView()]
        );
    }
}
