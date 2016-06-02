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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use AppBundle\Form\UserImageType;
use AppBundle\Entity\ProfilePicture;

/**
 * Description of UserImageController
 *
 * @author toconuts <toconuts@gmail.com>
 * 
 * @Route("/test")
 */
class UserImageController extends Controller
{
    /**
     * @Route("/new", name="user_image_form")
     * @Method({"GET"})
     */
    public function newAction()
    {
        $form = $this->createForm(UserImageType::class, null, ['method' => 'POST']);
        dump($form);
        
        return $this->render('userimage/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("", name="user_image_create")
     * @Method({"POST"})
     */
    public function createAction(Request $request)
    {
        $image = new ProfilePicture();
        $form = $this->createForm(UserImageType::class, $image);

        $form->handleRequest($request);
        if ($form->isValid()) {
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($image);
            $em->flush();

            return $this->redirect($this->generateUrl('user_image_list'));
        }

        return $this->redirect($this->generateUrl('user_image_form'));
    }
    
    /**
     * @Route("/update", name="user_image_update")
     */
    public function updateAction(Request $request)
    {
        $image = new ProfilePicture();
        
        $form = $this->createForm(UserImageType::class, $image);
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($image);
            $em->flush();
            
            return $this->redirectToRoute('user_image_list');
        }
        
        return $this->render(
            'userimage/new.html.twig',
            array('form' => $form->createView())
        );
    }
    
    /**
     * @Route("", name="user_image_list")
     * @Method({"GET"})
     */
    public function listAction()
    {
        $images = $this->getDoctrine()->getRepository('AppBundle:ProfilePicture')->findAll();
        dump($images);
        return $this->render(
            'userimage/list.html.twig',
            array('images' => $images)
        );
    }

    /**
     * @Route("/{id}", requirements = {"id" = "\d+"}, name="user_image_delete")
     * @Method({"DELETE"})
     * @ParamConverter("image", class="AppBundle:UserImage")
     */
    public function deleteAction(ProfilePicture $image)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($image);
        $em->flush();

        return $this->redirect($this->generateUrl('user_image_list'));
    }
}
