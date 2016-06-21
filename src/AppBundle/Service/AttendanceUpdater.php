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

/**
 * Description of AttendanceUpdator
 *
 * @author toconuts <toconuts@gmail.com>
 */
class AttendanceUpdater
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
    
    public function updateAll(Activity $activity)
    {
        $users = $this->entityManager->getRepository('AppBundle:User')->findAll();
        foreach ($users as $user) {
            $this->update($user, $activity);
        }
        $this->entityManager->flush();
    }
    
    public function createAttendance(User $user)
    {
        $activities = $this->entityManager->getRepository('AppBundle:Activity')->findAll();
        foreach ($activities as $activity) {
            $this->update($user, $activity);
        }
        $this->entityManager->flush();
    }
    
    protected function update(User $user, Activity $activity)
    {
        $attendance = $user->findAttendance($activity);
        if ($attendance && !$activity->getIsConfirm()) {
            $user->removeAttendance($attendance);
            $this->entityManager->remove($attendance);
        } else if ($activity->getIsConfirm() && 
                   $this->isTarget($user, $activity)) {
            $attendance = new Attendance($user, $activity);
            $user->addAttendance($attendance);
            $this->entityManager->persist($attendance);
        }
    }
    
    protected function isTarget(User $user, Activity $activity)
    {
        return ($user->getOccupation() & $activity->getTarget());
    }
}
