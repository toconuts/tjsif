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
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use AppBundle\Utils\ChoiceList\TargetChoiceLoader;

use AppBundle\Entity\Activity;
use AppBundle\Form\ActivityType;

/**
 * Description of ActivityController
 *
 * @author toconuts <toconuts@gmail.com>
 * 
 * @Route("/member/activity")
 */
class ActivityController extends Controller
{
    /**
     * @Route("", name="member_activity_index")
     */
    public function indexAction(Request $request)
    {
        $dql   = 'SELECT a FROM AppBundle:Activity a WHERE a.isOfficial = :official ORDER BY a.starttime ASC, a.endtime ASC';
        $em    = $this->getDoctrine()->getManager();
        
        // Official
        $queryOfficial = $em->createQuery($dql)->setParameter('official', true);

        $paginator  = $this->get('knp_paginator');
        $paginationOfficial = $paginator->paginate(
            $queryOfficial,
            $request->query->getInt('pageOfficial', 1),
            Activity::NUM_ITEMS,
            array(
                'pageParameterName' => 'pageOfficial',
                'sortFieldParameterName' => 'sortOfficial',
                'sortDirectionParameterName' => 'directionOfficial',
            )
        );
        
        // Official
        $queryUnofficial = $em->createQuery($dql)->setParameter('official', false);

        $paginator  = $this->get('knp_paginator');
        $paginationUnofficial = $paginator->paginate(
            $queryUnofficial,
            $request->query->getInt('pageUnofficial', 1),
            Activity::NUM_ITEMS,
            array(
                'pageParameterName' => 'pageUnofficial',
                'sortFieldParameterName' => 'sortUnofficial',
                'sortDirectionParameterName' => 'directionUnofficial',
            )
        );

        return $this->render('activity/index.html.twig', array(
            'paginationOfficial' => $paginationOfficial,
            'paginationUnofficial' => $paginationUnofficial,
            'targetChoices'    => (new TargetChoiceLoader())->getChoicesFliped(),
        ));
        
        
        /*
        $dql   = 'SELECT a FROM AppBundle:Activity a ORDER BY a.starttime ASC, a.endtime ASC';
        
        $em    = $this->getDoctrine()->getManager();
        $query = $em->createQuery($dql);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            Activity::NUM_ITEMS // limit per page
        );

        return $this->render('activity/index.html.twig', array(
            'pagination' => $pagination,
            'targetChoices'    => (new TargetChoiceLoader())->getChoicesFliped(),
        ));*/
    }
    
    /**
     * @Route("/{id}", requirements = {"id" = "\d+"}, name="member_activity_show")
     * @ParamConverter("activity", class="AppBundle:Activity")
     */
    public function showAction(Activity $activity)
    {   
        $form = $this->createForm(
            ActivityType::class,
            $activity,
            array(
                'disabled' => true
        ));
        
        return $this->render(
            'activity/show.html.twig',
            array('activity' => $activity,
                'form' => $form->createView()
            )
        );
    }
    
    /**
     * @Route("/new", name="member_activity_new")
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
            
            return $this->redirectToRoute('member_activity_index');

        }
        
        return $this->render(
            'activity/new.html.twig',
            array('form' => $form->createView())
        );
    }
    
    /**
     * @Route("/{id}/edit", requirements = {"id" = "\d+"}, name="member_activity_edit")
     * @ParamConverter("activity", class="AppBundle:Activity")
     */
    public function editAction(Request $request, Activity $activity)
    {
        if (!$this->get('security.authorization_checker')
                ->isGranted('ROLE_SUPER_ADMIN') && 
            ($this->getUser()->getId() != $activity->getCreatedBy()->getId())) {
                $this->createAccessDeniedException();
        }
        
        $disabled = ($this->get('security.authorization_checker')
                ->isGranted('ROLE_SUPER_ADMIN')) ? false : true;
        
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
            return $this->redirectToRoute('member_activity_index');
        }
        
        return $this->render(
            'activity/edit.html.twig',
            array(
                'form' => $form->createView(),
                'activity' => $activity
            )
        );
    }
    
    /**
     * @Route("/{id}/active", requirements = {"id" = "\d+"}, name="member_activity_activate")
     * @Method({"ACTIVATE"})
     * @ParamConverter("activity", class="AppBundle:Activity")
     */
    public function activateAction(Activity $activity)
    {
        $activity->setIsActive(true);
        $em = $this->getDoctrine()->getManager();
        $em->flush();
        
        return $this->redirectToRoute('member_activity_index');
    }
    
    /**
     * @Route("/{id}/inactive", requirements = {"id" = "\d+"}, name="member_activity_inactivate")
     * @Method({"INACTIVATE"})
     * @ParamConverter("activity", class="AppBundle:Activity")
     */
    public function inactivateAction(Activity $activity)
    {
        $activity->setIsActive(false);
        $em = $this->getDoctrine()->getManager();
        $em->flush();
        
        return $this->redirectToRoute('member_activity_index');
    }
    
    /**
     * @Route("/{id}/delete", requirements = {"id" = "\d+"}, name="member_activity_delete")
     * @Method({"DELETE"})
     * @ParamConverter("activity", class="AppBundle:Activity")
     */
    public function deleteAction(Activity $activity)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($activity);
        $em->flush();
        
        return $this->redirectToRoute('member_activity_index');
    }
}
