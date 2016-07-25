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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

//for test
use AppBundle\Entity\ProfilePicture2;
use AppBundle\Form\PictureType;

/**
 * Description of MemberController
 *
 * @author toconuts <toconuts@gmail.com>
 * 
 * @Route("/member")
 */
class MemberController extends Controller
{
    /**
     * @Route("", name="member_index")
     */
    public function indexAction()
    {
//TODO: paesonary notification
        
        return $this->render(
            'member/index.html.twig'
        );
    }
    
    /**
     * @Route("/test", name="member_test")
     */
    public function testAction(Request $request)
    {
        $document = new \AppBundle\Entity\Document();
        $document->setType('1');
        $form = $this->createForm(\AppBundle\Form\UploadDocumentType::class, $document);

        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) { 
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($document);
            $em->flush();

            return $this->redirect($this->generateUrl('member_test'));
        }
        return $this->render(
            'member/test.html.twig',
            array('form' => $form->createView()))
        ;
    }
    
    /**
     * @Route("/test2", name="member_test2")
     */
    public function test2Action(Request $request)
    {
        $image = new ProfilePicture2();
        $form = $this->createForm(PictureType::class, $image);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($image);
            $em->flush();

            return $this->redirect($this->generateUrl('member_test2'));
        }
        
        return $this->render(
            'member/test2.html.twig',
            array('form' => $form->createView()))
        ;
    }
}
