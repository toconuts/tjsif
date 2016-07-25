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
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use AppBundle\Controller\AbstractAppController;
use AppBundle\Entity\Notification;

/**
 * Description of NotificationController
 *
 * @author toconuts <toconuts@gmail.com>
 * 
 * @Route("/member/notification")
 */
class NotificationController extends AbstractAppController
{
    /**
     * @Route("", name="member_notification_index")
     */
    public function indexAction(Request $request)
    {
        $dql   = "SELECT n FROM AppBundle:Notification n INNER JOIN n.createdBy u ORDER BY n.createdAt DESC";
        
        $em    = $this->getDoctrine()->getManager();
        $query = $em->createQuery($dql);
        
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            Notification::NUM_ITEMS // limit per page
        );
                
        return $this->render('notification/index.html.twig', array(
            'pagination' => $pagination,
        ));
    }
    
    public function toppageAction()
    {
        $notifications = $this->getDoctrine()->getManager()
                ->getRepository('AppBundle:Notification')
                ->getLatestNotifications(Notification::NUM_LATEST_ITEMS);

        return $this->render('components/member/notification_toppage.html.twig', array(
            'notifications' => $notifications,
        ));
    }
}
