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
    public function indexAction()
    {
//TODO: Query date > now() && date asc demo iru? iranaikamo
        $activities = $this->getDoctrine()->getRepository('AppBundle:Activity')->findAll();
        dump($activities);
        return $this->render(
            'activity/index.html.twig',
            array('activities' => $activities)
        );
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

            return $this->redirectToRoute('member_activity_show',
                array('id' => $activity->getId()));

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
        $disabled = ($this->get('security.authorization_checker')
                ->isGranted('ROLE_SUPER_ADMIN')) ? false : true;
        
        $form = $this->createForm(ActivityType::class, $activity, array(
            'official_disabled' => $disabled,
        ));
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

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
