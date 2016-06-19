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

/**
 * Description of BbsPostController
 *
 * @author toconuts <toconuts@gmail.com>
 * 
 * @Route("/member/bbs")
 */
class BbsPostController extends Controller
{
    /**
     * @Route("", name="member_bbs_index")
     */
    public function indexAction()
    {
        $posts = $this->getDoctrine()->getManager()->getRepository('AppBundle:BbsPost')->getLatestPost();
        
        return $this->render('bbspost/index.html.twig',array(
            'posts' => $posts,
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
     */
    public function newAction(Request $request)
    {
        $disabled = ($this->get('security.authorization_checker')
                ->isGranted('ROLE_SUPER_ADMIN')) ? false : true;
        
        $activity = new Activity();
        $form = $this->createForm(ActivityType::class, $activity, array(
            'official_disabled' => $disabled,
        ));
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($activity);
            $em->flush();

            $ap = $this->get('app.attendance_updater');
            $ap->updateAll($activity);
            
            return $this->redirectToRoute('member_bbs_index');

        }
        
        return $this->render(
            'bbspost/new.html.twig',
            array('form' => $form->createView())
        );
    }
    
    /**
     * @Route("/{id}/edit", requirements = {"id" = "\d+"}, name="member_bbs_edit")
     * @ParamConverter("post", class="AppBundle:BbsPost")
     */
    public function editAction(Request $request, BbsPost $post)
    {        
        $form = $this->createForm(ActivityType::class, $activity, array(
            'official_disabled' => $disabled,
        ));
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            
            $ap = $this->get('app.attendance_updater');
            $ap->updateAll($activity);

//TODO: Add Flash Message
            return $this->redirectToRoute('member_bbs_index');
        }
        
        return $this->render(
            'bbspost/edit.html.twig',
            array(
                'form' => $form->createView(),
                'activity' => $activity
            )
        );
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
        
        $commentLimit   = $this->container
                           ->getParameter('bbs.comments.latest_comment_limit');
        
        $latestComments = $em->getRepository('AppBundle:BbsComment')
                         ->getLatestComments($commentLimit);

        return $this->render('components/member/bbs_sidebar.html.twig', array(
            'tags' => $tagWeights,
            'latestComments' => $latestComments,
        ));
    }
}
