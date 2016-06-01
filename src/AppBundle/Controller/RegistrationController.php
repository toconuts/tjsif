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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Form\RegistrationType;
use AppBundle\Entity\User;

/**
 * Description of RegistrationController
 *
 * @author toconuts <toconuts@gmail.com>
 */
class RegistrationController extends Controller
{
    /**
     * @Route("/register", name="user_registration")
     */
    public function registerAction(Request $request)
    {
        $rm = $this->get('app.registration_manager');
        
        $ticket = $request->query->get('key');
        $invitation = $rm->getInvitation($ticket);
        dump($invitation);
        if (!$invitation) {
            throw $this->createNotFoundException(
                'Invalid Access because the invitation is not correct or might be expired.'
            );
        }
        
        $user = new User();   
        $user->setEmail($invitation->getEmail());
        
        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {

            $rm->registerUser($user, $invitation);

            if ($rm->isChangedEmail($user, $invitation)) {
                $session = $request->getSession();
                $session->set('registration/user', $user);
                return $this->redirectToRoute('user_confirm');
            }

            $this->addFlash(
                'success',
                'Conglats! After login, you can access TJ-SIF 2016 member\'s site.'
            );

            return $this->redirectToRoute('login');
            
        }

        return $this->render(
            'registration/register.html.twig',
            array('form' => $form->createView())
        );
    }
    
    /**
     * @Route("/confirm", name="user_confirm")
     */
    public function confirmAction(Request $request)
    {
        $session = $request->getSession();
        $user = $session->get('registration/user');
        if (!$user) {
            throw $this->createNotFoundException();
        }
        
        return $this->render(
            'registration/confirm.html.twig',
            array('user' => $user)
        );
    }
    
    /**
     * @Route("/activate", name="user_activate")
     */
    public  function activateAction(Request $request)
    {
        $rm = $this->get('app.registration_manager');
        $activationKey = $request->query->get('key');
        
        if (!$activationKey || !$rm->activateUser($activationKey)) {
            throw $this->createNotFoundException(
                'Invalid Access because the invitation is not correct or might be expired.'
            );

        }

        $this->addFlash(
            'success',
            'Conglats! After login, you can access TJ-SIF 2016 member\'s site.'
        );

        return $this->redirect('login');
    }
}
