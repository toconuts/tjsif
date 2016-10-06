<?php

/*
 * This file is part of the TJ-SIF 2016 project.
 *
 * (c) toconuts <toconuts@google.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Service;

use Doctrine\ORM\EntityManager;
use AppBundle\Entity\User;
use AppBundle\Entity\Activity;
use AppBundle\Entity\Attendance;
use AppBundle\Form\Model\FactoryTour;
use AppBundle\Utils\ChoiceList\FactoryTourChoiceLoader;
use AppBundle\Utils\ChoiceList\AttendanceChoiceLoader;

/**
 * Description of FactoryTourManager
 *
 * @author toconuts <toconuts@gmail.com>
 */
class FactoryTourManager
{
    /**
     * Entity Manager
     * 
     * @var EntityManager
     */
    private $entityManager;
    
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    public function getAttendance(User $user)
    {
        $names = (new FactoryTourChoiceLoader())->getChoicesFliped();
        $activities = $this->entityManager->getRepository('AppBundle:Activity')->findByNameIn($names);
        foreach ($activities as $activity) {
            $attendance = $user->findAttendance($activity);
            if ($attendance) {
                return $attendance;
            }
        }
        return null;
    }
    
    public function createAttendance(User $user, FactoryTour $factoryTour)
    {
        $names = (new FactoryTourChoiceLoader())->getChoicesFliped();
        $activity = $this->entityManager->getRepository('AppBundle:Activity')->findOneBy(array('name' => $names[$factoryTour->getCompany()]));
        
        if (!$activity) {
            throw new \Exception('Can not find the activity you specified.');
        }
        
        $a = new Activity();
        if ($activity->getAttendances()->count() >= FactoryTour::$CAPACITIES[$factoryTour->getCompany()]) {
            $message = 'Sorry, please select another course because ' . $names[$factoryTour->getCompany()] .  ' was filled to capacity.';
            throw new \Exception($message);
        }
        
        $attendance = new Attendance($user, $activity);
        $attendance->setStatus(AttendanceChoiceLoader::ATTENDANCE_YES_VALUE);
        $user->addAttendance($attendance);
        $this->entityManager->persist($attendance);
        $this->entityManager->flush();
    }
    
    public function updateNumbersOfRegisters(FactoryTour $factoryTour)
    {
        $factoryTour->resetNumberOfRegisters();
        $choices = (new FactoryTourChoiceLoader())->getChoicesFliped();
        $ar = $this->entityManager->getRepository('AppBundle:Activity');
        foreach ($choices as $id => $name) {
            $activity = $ar->findOneBy(array('name' => $name));
            $factoryTour->addNumbersOfRegisters($id, ($activity) ? $activity->getAttendances()->count() : 0);
        }
        return $factoryTour;
    }
    
}
