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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

use AppBundle\Entity\BbsComment;
use AppBundle\Entity\BbsPost;
use AppBundle\Form\BbsCommentType;

/**
 * Description of BbsCommentController
 *
 * @author toconuts <toconuts@gmail.com>
 * 
 * @Route("/member/bbs")
 */
class BbsCommentController extends Controller
{
    /**
     * @Route("/{id}/comment/new", requirements = {"id" = "\d+"}, name="member_bbs_comment_new")
     * @ParamConverter("post", class="AppBundle:BbsPost")
     * @Method({"GET"})
     */
    public function newAction(Request $request, BbsPost $post)
    {
        $comment = new BbsComment($post);
        $form = $this->createForm(BbsCommentType::class, $comment, array(
            'action' => $this->generateUrl('member_bbs_comment_create', array('id' => $post->getId())),
            'method' => 'POST',
        ));
        
        return $this->render('bbscomment/new.html.twig', array(
                'form' => $form->createView(),
                'comment' => $comment,
        ));
    }
    
    /**
     * @Route("/{id}/comment/new", requirements = {"id" = "\d+"}, name="member_bbs_comment_create")
     * @ParamConverter("post", class="AppBundle:BbsPost")
     * @Method({"POST"})
     */
    public function createAction(Request $request, BbsPost $post)
    {
        $comment = new BbsComment($post);   
        $form = $this->createForm(BbsCommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isValid()) {
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();
            
            return $this->redirect($this->generateUrl('member_bbs_show', array(
                'id' => $post->getId())) .
                '#comment-' . $comment->getId()
            );
        }

        return $this->render('bbscomment/create.html.twig', array(
            'form'    => $form->createView(),
            'comment' => $comment,
        ));
    }
    
    /**
     * @Route("/{id}/comment/edit", requirements = {"id" = "\d+"}, name="member_bbs_comment_edit")
     * @ParamConverter("comment", class="AppBundle:BbsComment")
     */
    public function editAction(Request $request, BbsComment $comment)
    {
        $form = $this->createForm(BbsCommentType::class, $comment);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            
            return $this->redirectToRoute('member_bbs_show', array(
                'id' => $comment->getPost()->getId(),
            ));
        }
        
        return $this->render('bbs/edit.html.twig', array(
                'form' => $form->createView(),
        ));
    }
    
    /**
     * @Route("/{id}/comment/delete", requirements = {"id" = "\d+"}, name="member_bbs_comment_delete")
     * @Method({"DELETE"})
     * @ParamConverter("post", class="AppBundle:BbsPost")
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     */
    public function deleteAction(BbsPost $post)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($post);
        $em->flush();
        
        return $this->redirectToRoute('member_bbs_index');
    }
}
