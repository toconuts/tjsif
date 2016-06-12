<?php

/*
 * This file is part of the TJ-SIF 2016 project.
 *
 * (c) toconuts <toconuts@google.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Attendance;

/**
 * Description of LoadAttendanceData
 *
 * @author toconuts <toconuts@gmail.com>
 */
class LoadAttendanceData extends AbstractFixture implements OrderedFixtureInterface
{
    
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        /* Attendance for user admin */
        // Activity 1
        $attendance_1_1 = $this->createAttendance(
            $this->getReference('user-super-admin'),
            $this->getReference('activity-1'),
            true);
        $manager->persist($attendance_1_1);
        
        $attendance_1_2 = $this->createAttendance(
            $this->getReference('user-admin'),
            $this->getReference('activity-1'),
            true);
        $manager->persist($attendance_1_2);
        
        $attendance_1_3 = $this->createAttendance(
            $this->getReference('user-user'),
            $this->getReference('activity-1'),
            true);
        $manager->persist($attendance_1_3);
        
        // Activity 3
        $attendance_2_1 = $this->createAttendance(
            $this->getReference('user-super-admin'),
            $this->getReference('activity-3'),
            true);
        $manager->persist($attendance_2_1);
        
        $attendance_2_2 = $this->createAttendance(
            $this->getReference('user-admin'),
            $this->getReference('activity-3'),
            true);
        $manager->persist($attendance_2_2);
        
        $attendance_2_3 = $this->createAttendance(
            $this->getReference('user-user'),
            $this->getReference('activity-3'),
            true);
        $manager->persist($attendance_2_3);
        
        $manager->flush();
    }
    
    protected function createAttendance($user, $activity, $isAttend)
    {
        $attendance = new Attendance();
        $attendance->setUser($user);
        $attendance->setActivity($activity);
        $attendance->setIsAttend($isAttend);
        return $attendance;
    }


    public function getOrder()
    {
        return 31;
    }
}
