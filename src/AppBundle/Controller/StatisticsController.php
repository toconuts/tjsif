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

/**
 * Description of StatisticsController
 *
 * @author toconuts <toconuts@gmail.com>
 * 
 * @Route("/member/statistics")
 */
class StatisticsController extends Controller
{
    /**
     * @Route("", name="member_statistics_index")
     */
    public function indexAction()
    {
        //$organizations = $this->getDoctrine()->getRepository('AppBundle:Organization')->findAll();
        
        $em = $this->getDoctrine()->getManager();
        $qb = $this->getDoctrine()->getManager()->createQueryBuilder();
        
        $qb->select('o, SUM(CASE WHEN u.occupation=1  AND u.isActive=true THEN 1 ELSE 0 END),
                        SUM(CASE WHEN u.occupation=2  AND u.isActive=true THEN 1 ELSE 0 END),
                        SUM(CASE WHEN u.occupation=4  AND u.isActive=true THEN 1 ELSE 0 END),
                        SUM(CASE WHEN u.occupation=8  AND u.isActive=true THEN 1 ELSE 0 END),
                        SUM(CASE WHEN u.occupation=16 AND u.isActive=true THEN 1 ELSE 0 END),
                        SUM(CASE WHEN u.occupation=32 AND u.isActive=true THEN 1 ELSE 0 END)')
            ->from('AppBundle:Organization', 'o')
            ->leftJoin('o.users', 'u')
            //->where('o.type = 1 OR o.type = 2 OR o.type = 3')
            ->groupBy('o.id')
        ;
        $registrationList = $qb->getQuery()->getResult();
        dump($registrationList);
        
        $qb->select('o, SUM(CASE WHEN p.category=1 AND p.isActive=true THEN 1 ELSE 0 END),
                        SUM(CASE WHEN p.category=2 AND p.isActive=true THEN 1 ELSE 0 END),
                        SUM(CASE WHEN p.category=3 AND p.isActive=true THEN 1 ELSE 0 END),
                        SUM(CASE WHEN p.category=4 AND p.isActive=true THEN 1 ELSE 0 END),
                        SUM(CASE WHEN p.category=5 AND p.isActive=true THEN 1 ELSE 0 END),
                        SUM(CASE WHEN p.category=6 AND p.isActive=true THEN 1 ELSE 0 END),
                        SUM(CASE WHEN p.category=7 AND p.isActive=true THEN 1 ELSE 0 END)')
            ->from('AppBundle:Organization', 'o')
            ->leftJoin('o.projects', 'p')
            ->where('o.type = 1 OR o.type = 2 OR o.type = 3')
            ->groupBy('o.id')
        ;
        $projectList = $qb->getQuery()->getResult();
        
        return $this->render('statistics/index.html.twig', array(
            'registrationList' => $registrationList,
            'projectList' => $projectList,
        ));
    }
}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   