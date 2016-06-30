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
use AppBundle\Utils\ChoiceList\AttendanceChoiceLoader;

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
        /* Attendance for
         * _1 = user-super-admin
         * _2 = user-admin
         * _3 = user-user 
         */

        // Activity 1
        $attendance_1_1 = new Attendance();
        $attendance_1_1->setUser($this->getReference('user-super-admin'));
        $attendance_1_1->setActivity($this->getReference('activity-1'));
        $attendance_1_1->setStatus(AttendanceChoiceLoader::ATTENDANCE_YES_VALUE);
        $manager->persist($attendance_1_1);
        
        $attendance_1_2 = new Attendance();
        $attendance_1_2->setUser($this->getReference('user-admin'));
        $attendance_1_2->setActivity($this->getReference('activity-1'));
        $attendance_1_2->setStatus(AttendanceChoiceLoader::ATTENDANCE_NO_VALUE);
        $manager->persist($attendance_1_2);
        
        $attendance_1_3 = new Attendance();
        $attendance_1_3->setUser($this->getReference('user-user'));
        $attendance_1_3->setActivity($this->getReference('activity-1'));
        $attendance_1_3->setStatus(AttendanceChoiceLoader::ATTENDANCE_MAYBE_VALUE);
        $manager->persist($attendance_1_3);
        
        // Activity 3
        $attendance_3_1 = new Attendance();
        $attendance_3_1->setUser($this->getReference('user-super-admin'));
        $attendance_3_1->setActivity($this->getReference('activity-3'));
        $attendance_3_1->setStatus(AttendanceChoiceLoader::ATTENDANCE_NO_VALUE);
        $manager->persist($attendance_3_1);
        
        $attendance_3_2 = new Attendance();
        $attendance_3_2->setUser($this->getReference('user-admin'));
        $attendance_3_2->setActivity($this->getReference('activity-3'));
        $attendance_3_2->setStatus(AttendanceChoiceLoader::ATTENDANCE_MAYBE_VALUE);
        $manager->persist($attendance_3_2);
        
        $attendance_3_3 = new Attendance();
        $attendance_3_3->setUser($this->getReference('user-user'));
        $attendance_3_3->setActivity($this->getReference('activity-3'));
        $attendance_3_3->setStatus(AttendanceChoiceLoader::ATTENDANCE_YES_VALUE);
        $manager->persist($attendance_3_3);
        
        $manager->flush();
    }

    public function getOrder()
    {
        return 31;
    }
}
