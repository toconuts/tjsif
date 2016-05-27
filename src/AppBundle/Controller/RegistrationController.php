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
use AppBundle\Form\UserType;
use AppBundle\Entity\User;

use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use AppBundle\Form\InvitationType;


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

            $this->get('app.registration_manager')->registerUser($user, 'ticket');
/*
            $password = $this->get('security.password_encoder')
                ->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            //delete activationkey from invitation
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
*/
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
     * @Route("/confirm", name="user_confirm")
     */
    public function confirmAction(Request $request)
    {
        return array();
    }
    
    /**
     * @Route("/activate", name="user_activate")
     */
    public  function activateAction(Request $request)
    {
        return array();
    }
}
