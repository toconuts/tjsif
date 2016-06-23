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
use AppBundle\Utils\ChoiceList\TargetChoiceLoader;

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
        /* Target */
        // All
        $activity1 = new Activity();
        $activity1->setName('Welcome session');
        $activity1->setVenue('Hall');
        $activity1->setStarttime(new \DateTime('2016-12-21 09:00:00'));
        $activity1->setEndtime(new \DateTime('11:00:00'));
        $activity1->setTarget(TargetChoiceLoader::TARGET_ALL_ID);
        $activity1->setIsConfirm(true);
        $activity1->setIsOfficial(true);
        $activity1->setCreatedBy($this->getReference('user-super-admin'));
        $manager->persist($activity1);
        
        // Student
        $activity2 = new Activity();
        $activity2->setName('Welcome at the gate');
        $activity2->setVenue('Gate');
        $activity2->setStarttime(new \DateTime('2016-12-20 13:00:00'));
        $activity2->setEndtime(new \DateTime('17:00:00'));
        $activity2->setTarget(TargetChoiceLoader::TARGET_STUDENT_ID);
        $activity2->setIsConfirm(false);
        $activity2->setIsOfficial(false);
        $activity2->setCreatedBy($this->getReference('user-user'));
        $manager->persist($activity2);
        
        // Teacher
        $activity3 = new Activity();
        $activity3->setName('Meeting for xxxxxxxxxxx');
        $activity3->setVenue('Meeting room A');
        $activity3->setStarttime(new \DateTime('2016-12-20 20:00:00'));
        $activity3->setEndtime(new \DateTime('21:00:00'));
        $activity3->setTarget(TargetChoiceLoader::TARGET_TEACHER_ID);
        $activity3->setIsConfirm(true);
        $activity3->setIsOfficial(false);
        $activity3->setCreatedBy($this->getReference('user-admin'));
        $manager->persist($activity3);
        
        // Principals
        $activity4 = new Activity();
        $activity4->setName('Stearing Meeting');
        $activity4->setVenue('Meeting room B');
        $activity4->setStarttime(new \DateTime('2016-12-21 13:00:00'));
        $activity4->setEndtime(new \DateTime('15:00:00'));
        $activity4->setTarget(TargetChoiceLoader::TARGET_PRINCIPALS_ID);
        $activity4->setIsConfirm(false);
        $activity4->setIsOfficial(true);
        $activity4->setCreatedBy($this->getReference('user-super-admin'));
        $manager->persist($activity4);
        
        // JOCV
        $activity5 = new Activity();
        $activity5->setName('JICA Meeting');
        $activity5->setVenue('Meeting room C');
        $activity5->setStarttime(new \DateTime('2016-12-22 09:00:00'));
        $activity5->setEndtime(new \DateTime('11:00:00'));
        $activity5->setTarget(TargetChoiceLoader::TARGET_JOCV_ID);
        $activity5->setIsConfirm(true);
        $activity5->setIsOfficial(false);
        $activity5->setCreatedBy($this->getReference('user-jocv'));
        $manager->persist($activity5);
        
        // The other
        $activity6 = new Activity();
        $activity6->setName('School tour');
        $activity6->setVenue('Meet at reception');
        $activity6->setStarttime(new \DateTime('2016-12-21 13:00:00'));
        $activity6->setEndtime(new \DateTime('15:00:00'));
        $activity6->setTarget(TargetChoiceLoader::TARGET_THEOTHER_ID);
        $activity6->setIsConfirm(false);
        $activity6->setIsOfficial(false);
        $activity6->setCreatedBy($this->getReference('user-theother'));
        $manager->persist($activity6);
        
        // Student & teacher
        $activity7 = new Activity();
        $activity7->setName('Guidance about JICA');
        $activity7->setVenue('Meeting room A');
        $activity7->setStarttime(new \DateTime('2016-12-21 15:00:00'));
        $activity7->setEndtime(new \DateTime('16:00:00'));
        $activity7->setTarget(TargetChoiceLoader::TARGET_STUDENT_AND_TEACHER_ID);
        $activity7->setIsConfirm(true);
        $activity7->setIsOfficial(true);
        $activity7->setCreatedBy($this->getReference('user-super-admin'));
        $manager->persist($activity7);
        
        // Teacher $ Principals
        $activity8 = new Activity();
        $activity8->setName('Review for the event');
        $activity8->setVenue('Multimedia room');
        $activity8->setStarttime(new \DateTime('2016-12-23 15:00:00'));
        $activity8->setEndtime(new \DateTime('16:00:00'));
        $activity8->setTarget(TargetChoiceLoader::TARGET_TEACHER_AND_PRINCIPALS_ID);
        $activity8->setIsConfirm(false);
        $activity8->setIsOfficial(true);
        $activity8->setCreatedBy($this->getReference('user-super-admin'));
        $manager->persist($activity8);
        
        /* Inactive */
        // Official
        $activity9 = new Activity();
        $activity9->setName('Eve of Festival');
        $activity9->setVenue('Schoolyard');
        $activity9->setStarttime(new \DateTime('2016-12-20 18:00:00'));
        $activity9->setEndtime(new \DateTime('15:00:00'));
        $activity9->setTarget(TargetChoiceLoader::TARGET_ALL_ID);
        $activity9->setIsConfirm(true);
        $activity9->setIsOfficial(true);
        $activity9->setIsActive(false);
        $activity9->setCreatedBy($this->getReference('user-super-admin'));
        $manager->persist($activity9);
        
        $activity10 = new Activity();
        $activity10->setName('Seeing Starlight');
        $activity10->setVenue('gymnasium');
        $activity10->setStarttime(new \DateTime('2016-12-21 13:00:00'));
        $activity10->setEndtime(new \DateTime('15:00:00'));
        $activity10->setTarget(TargetChoiceLoader::TARGET_ALL_ID);
        $activity10->setIsConfirm(true);
        $activity10->setIsOfficial(false);
        $activity10->setIsActive(false);
        $activity10->setCreatedBy($this->getReference('user-user'));
        $manager->persist($activity10);
        
        /* Activity 1 */
       /* $activity1 = $this->createActivity(
            'Activity number 1', 
            new \DateTime('2016-12-21 13:00:00'),
            new \DateTime('15:00:00'),
            0b00111111, //ALL
            true,
            true
        );
        $activity1->setCreatedBy($this->getReference('user-super-admin'));
        $manager->persist($activity1);*/
        
        /* Activity 2 */
        /*$activity2 = $this->createActivity(
            'Activity number 2 - **************************************', 
            new \DateTime('2016-12-21 15:00:00'),
            new \DateTime('17:00:00'),
            0b00000011, //Student and teacher
            false,
            false
        );
        $activity2->setCreatedBy($this->getReference('user-user'));
        $manager->persist($activity2);*/
        
        /* Activity 3 */
        /*$activity3 = $this->createActivity(
            'Activity number 3 - Duis mollis, est non commodo luctus, nisi erat',
            new \DateTime('2016-12-21 17:00:00'),
            new \DateTime('20:00:00'),
            0b00000011, //Student and teacher
            true,
            false
        );
        $activity3->setCreatedBy($this->getReference('user-admin'));
        $manager->persist($activity3);*/
        
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
