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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use AppBundle\Entity\User;
use AppBundle\Form\UserType;

/**
 * Description of UserController
 *
 * @author toconuts <toconuts@gmail.com>
 * 
 * @Route("/member/user")
 */
class UserController extends Controller
{
    /**
     * @Route("/", name="user_index")
     */
    public function indexAction()
    {
        $users = $this->getDoctrine()->getRepository('AppBundle:User')->findAll();
        dump($users);
        return $this->render(
            'user/index.html.twig',
            array('users' => $users)
        );
    }
    
    /**
     * @Route("/{id}", requirements = {"id" = "\d+"}, name="user_show")
     * @ParamConverter("user", class="AppBundle:User")
     */
    public function showAction(User $user)
    {   
        return $this->render(
            'user/show.html.twig',
            array('user' => $user)
        );
    }
    
    /**
     * @Route("/{id}/edit", requirements = {"id" = "\d+"}, name="user_edit")
     * @ParamConverter("user", class="AppBundle:User")
     */
    public function editAction(Request $request, User $user)
    {
        if (!$user->isUser($this->getUser())) {
            throw $this->denyAccessUnlessGranted('edit', $user);
            //throw $this->createAccessDeniedException();
        }
        
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

//TODO: Add Flash Message
            return $this->redirectToRoute('user_list');
        }
        
        return $this->render(
            'user/edit.html.twig',
            array('form' => $form->createView())
        );
    }
    
    /**
     * @Route("/{id}", requirements = {"id" = "\d+"}, name="user_delete")
     * @Method({"DELETE"})
     * @ParamConverter("user", class="AppBundle:User")
     */
    public function unactiveAction(User $user)
    {
        $user->setIsActive(false);
        $em = $this->getDoctrine()->getManager();
        $em->flush();
        
        return $this->redirectToRoute('user_list');
    }
}
