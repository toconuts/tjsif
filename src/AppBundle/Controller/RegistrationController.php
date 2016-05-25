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
        $user = new User();
        
        $form = $this->createForm(UserType::class, $user);
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {

            $password = $this->get('security.password_encoder')
                ->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            //delete activationkey from invitation
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user

            return $this->redirectToRoute('replace_with_some_route');
        }

        return $this->render(
            'registration/register.html.twig',
            array('form' => $form->createView())
        );
    }
    
    /**
     * @Route("/admin/invitation")
     */
    public function inviteAction()
    {
        
        $invitation = new Invitation($this->getUser());
        $form = $this->createForm(InvitationType::class, $invitation);
        
        if ($form->isSubmitted() && $form->isValid()) {
            
            // create activation key
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($invitation);
            $em->flush();
            
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
