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

use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Monolog\Logger;
use AppBundle\Controller\AbstractAppController;
use AppBundle\Entity\BbsComment;
use AppBundle\Entity\BbsPost;
use AppBundle\Form\BbsCommentType;
use AppBundle\Utils\ChoiceList\GenderChoiceLoader;
use AppBundle\Entity\User;

/**
 * Description of BbsCommentController
 *
 * @author toconuts <toconuts@gmail.com>
 * 
 * @Route("/member/bbs")
 */
class BbsCommentController extends AbstractAppController
{
    
    /**
     * @Route("/{id}/comment/new", requirements = {"id" = "\d+"}, name="member_bbs_comment_new")
     * @ParamConverter("post", class="AppBundle:BbsPost")
     * @Method({"POST"})
     */
    public function newAction(Request $request, BbsPost $post)
    {
        $comment = new BbsComment($post);   
        $form = $this->createForm(BbsCommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isValid()) {
            
            $comment->getPost()->setUpdatedAt();
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();
            
            $url = $this->generateUrl('member_bbs_show', array('id' => $post->getId())) . '#comment-' . $comment->getId();
            
            $where = $this->createWhere($post->getUser(), $this->getUser());
            $this->log('commented on ' . $where, Logger::NOTICE, $url); 
            
            return $this->redirect($url);
        }

        return $this->render('bbscomment/form_error.html.twig', array(
            'form'    => $form->createView(),
            'post'    => $post,
        ));
    }
    
    /**
     * @ParamConverter("post", class="AppBundle:BbsPost")
     */
    public function formAction(Request $request, BbsPost $post)
    {
        $comment = new BbsComment($post);
        $form = $this->createForm(BbsCommentType::class, $comment);
        
        return $this->render('bbscomment/_form.html.twig', array(
                'form' => $form->createView(),
                'post' => $post,
        ));
    }
    
    protected function createWhere(User $postUser, User $appUser)
    {
        $where = '';
        if ($postUser->getId() == $appUser->getId()) {
            $where = $appUser->getPossessivePronoun() . ' own post.';
        } else {
            $where = $postUser->getFullname() . '\'s post.';
        }
        
        return $where;
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
