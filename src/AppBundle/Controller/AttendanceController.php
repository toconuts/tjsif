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
use AppBundle\Entity\User;
use AppBundle\Entity\Attendance;

/**
 * Description of AttendanceController
 *
 * @author toconuts <toconuts@gmail.com>
 * 
 * @Route("/member/attendance")
 */
class AttendanceController extends Controller
{
    /**
     * @Route("/{id}", requirements = {"id" = "\d+"}, name="member_attendance_show")
     * @ParamConverter("user", class="AppBundle:User")
     */
    public function showAction(User $user)
    {
        dump($user);
        $attendances = array(
            0 => $user->getAttendanceOfActivities(true),
            1 => $user->getAttendanceOfActivities(false),
        );
        
        dump($attendances);
        
        return $this->render(
            'attendance/show.html.twig', array(
                'user' => $user,
                'attendances' => $attendances,
            )
        );
    }
    
    /**
     * @Route("/{id}/status", requirements = {"id" = "\d+"}, name="member_attendance_status")
     * @ParamConverter("attendance", class="AppBundle:Attendance")
     */
    public function statusAction(Attendance $attendance, Request $request)
    {
        $status = 0;
        if ($request->request->has('Attendance_yes')) {
            $status = 1;
        } else if ($request->request->has('Attendance_no')) {
            $status = 2;
        }
        
        $attendance->setStatus($status);
        $em = $this->getDoctrine()->getManager();
        $em->flush();
        
        return $this->redirectToRoute(
            'member_attendance_show', 
            array('id' => $this->getUser()->getId())
        );
    }    
}
