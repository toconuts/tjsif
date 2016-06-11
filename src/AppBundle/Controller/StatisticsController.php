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
        $organizations = $this->getDoctrine()->getRepository('AppBundle:Organization')->findAll();
        return $this->render(
            'statistics/index.html.twig',
            array('organizations' => $organizations)
        );
    }
}