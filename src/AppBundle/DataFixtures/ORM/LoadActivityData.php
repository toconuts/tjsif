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
use AppBundle\Entity\Activity;

/**
 * Description of LoadActivityData
 *
 * @author toconuts <toconuts@gmail.com>
 */
class LoadActivityData extends AbstractFixture implements OrderedFixtureInterface
{
    
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        /* Activity 1 */
        $activity1 = $this->createActivity(
            'Activity number 1', 
            new \DateTime('2016-12-21 13:00:00'),
            new \DateTime('15:00:00'),
            0b00111111, //ALL
            true,
            true
        );
        $activity1->setCreatedBy($this->getReference('user-super-admin'));
        $manager->persist($activity1);
        
        /* Activity 2 */
        $activity2 = $this->createActivity(
            'Activity number 2 - **************************************', 
            new \DateTime('2016-12-21 15:00:00'),
            new \DateTime('17:00:00'),
            0b00000011, //Student and teacher
            false,
            false
        );
        $activity2->setCreatedBy($this->getReference('user-user'));
        $manager->persist($activity2);
        
        /* Activity 3 */
        $activity3 = $this->createActivity(
            'Activity number 3 - Duis mollis, est non commodo luctus, nisi erat',
            new \DateTime('2016-12-21 17:00:00'),
            new \DateTime('20:00:00'),
            0b00000011, //Student and teacher
            true,
            false
        );
        $activity3->setCreatedBy($this->getReference('user-admin'));
        $manager->persist($activity3);
        
        $manager->flush();
        
        $this->addReference('activity-1', $activity1);
        $this->addReference('activity-2', $activity2);
        $this->addReference('activity-3', $activity3);

    }
    
    protected function createActivity($name, $satrttime, $endtime, $target, $isConfirm, $isOfficial)
    {
        $activity = new Activity();
        $activity->setName($name);
        $activity->setStarttime($satrttime);
        $activity->setEndtime($endtime);
        $activity->setTarget($target);
        $activity->setIsConfirm($isConfirm);
        $activity->setIsOfficial($isOfficial);
        
        return $activity;
    }


    public function getOrder()
    {
        return 30;
    }
}
