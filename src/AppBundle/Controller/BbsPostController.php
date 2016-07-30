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
use AppBundle\Form\BbsPostType;

/**
 * Description of BbsPostController
 *
 * @author toconuts <toconuts@gmail.com>
 * 
 * @Route("/member/bbs")
 */
class BbsPostController extends AbstractAppController
{
    /**
     * @Route("", name="member_bbs_index")
     */
    public function indexAction(Request $request)
    {   
        $dql   = "SELECT p FROM AppBundle:BbsPost p ORDER BY p.id DESC";
        
        $em    = $this->getDoctrine()->getManager();
        $query = $em->createQuery($dql);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            BbsPost::NUM_ITEMS // limit per page
        );
        
        return $this->render('bbspost/index.html.twig',array(
            'pagination' => $pagination,
        ));
    }
    
    /**
     * @Route("/{id}", requirements = {"id" = "\d+"}, name="member_bbs_show")
     * @ParamConverter("post", class="AppBundle:BbsPost")
     */
    public function showAction(BbsPost $post)
    {   
        return $this->render('bbspost/show.html.twig', array(
            'post' => $post,
        ));
    }
    
    /**
     * @Route("/new", name="member_bbs_new")
     * @Method({"POST"})
     */
    public function newAction(Request $request)
    {
//        $request = $this->get('request_stack')->getMasterRequest();
        
        $post = new BbsPost();
        $form = $this->createForm(BbsPostType::class, $post);
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();
            
            $url = $this->generateUrl('member_bbs_index'). '#post-' . $post->getId();
            
            $this->log('posted new article. - ' . $post->getTitle(), Logger::NOTICE, $url);
            
            return $this->redirect($url);
        }
 
        return $this->render('bbspost/form_error.html.twig', array(
            'form'    => $form->createView(),
        ));
    }
    
    public function formAction()
    {
        $post = new BbsPost();

        $form = $this->createForm(BbsPostType::class, $post);
        
        return $this->render('bbspost/_form.html.twig', array(
                'form' => $form->createView(),
        ));
    }
    
    /**
     * @Route("/{id}/delete", requirements = {"id" = "\d+"}, name="member_bbs_delete")
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
    
    public function sidebarAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tags = $em->getRepository('AppBundle:BbsPost')
                   ->getTags();

        $tagWeights = $em->getRepository('AppBundle:BbsPost')
                         ->getTagWeights($tags);
        
        $latestComments = $em->getRepository('AppBundle:BbsComment')
                         ->getLatestComments(BbsComment::NUM_LATEST_ITEMS);

        return $this->render('components/member/bbs_sidebar.html.twig', array(
            'tags' => $tagWeights,
            'latestComments' => $latestComments,
        ));
    }
    
    public function toppageAction()
    {
        $posts = $this->getDoctrine()->getManager()
                ->getRepository('AppBundle:BbsPost')
                ->getLatestPost(BbsPost::NUM_LATEST_ITEMS);

        return $this->render('components/member/bbspost_toppage.html.twig', array(
            'posts' => $posts,
        ));
    }
}
