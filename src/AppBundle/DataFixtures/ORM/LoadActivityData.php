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
use AppBundle\Utils\ChoiceList\OccupationChoiceLoader;

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
        $activity1->setTargets(array(
            OccupationChoiceLoader::OCCUPATION_STUDENT_ID, 
            OccupationChoiceLoader::OCCUPATION_TEACHER_ID, 
            OccupationChoiceLoader::OCCUPATION_DEPUTY_ID,
            OccupationChoiceLoader::OCCUPATION_DIRECTOR_ID,
            OccupationChoiceLoader::OCCUPATION_JOCV_ID,
            OccupationChoiceLoader::OCCUPATION_THEOTHER_ID
        ));
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
        $activity2->setTargets(array(
            OccupationChoiceLoader::OCCUPATION_STUDENT_ID, 
        ));
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
        $activity3->setTargets(array(
            OccupationChoiceLoader::OCCUPATION_TEACHER_ID, 
        ));
        $activity3->setIsConfirm(true);
        $activity3->setIsOfficial(false);
        $activity3->setCreatedBy($this->getReference('user-admin'));
        $manager->persist($activity3);
        
        // Depty
        $activity4 = new Activity();
        $activity4->setName('Stearing Meeting');
        $activity4->setVenue('Meeting room B');
        $activity4->setStarttime(new \DateTime('2016-12-21 13:00:00'));
        $activity4->setEndtime(new \DateTime('15:00:00'));
        $activity4->setTargets(array(
            OccupationChoiceLoader::OCCUPATION_DEPUTY_ID,
        ));
        $activity4->setIsConfirm(false);
        $activity4->setIsOfficial(true);
        $activity4->setCreatedBy($this->getReference('user-super-admin'));
        $manager->persist($activity4);
        
        // Director
        $activity5 = new Activity();
        $activity5->setName('Director Meeting');
        $activity5->setVenue('Meeting room C');
        $activity5->setStarttime(new \DateTime('2016-12-22 09:00:00'));
        $activity5->setEndtime(new \DateTime('11:00:00'));
        $activity5->setTargets(array(
            OccupationChoiceLoader::OCCUPATION_DIRECTOR_ID,
        ));
        $activity5->setIsConfirm(true);
        $activity5->setIsOfficial(false);
        $activity5->setCreatedBy($this->getReference('user-admin'));
        $manager->persist($activity5);
        
        // JOCV
        $activity6 = new Activity();
        $activity6->setName('JICA Meeting');
        $activity6->setVenue('Meeting room C');
        $activity6->setStarttime(new \DateTime('2016-12-22 09:00:00'));
        $activity6->setEndtime(new \DateTime('11:00:00'));
        $activity6->setTargets(array(
            OccupationChoiceLoader::OCCUPATION_JOCV_ID,
        ));
        $activity6->setIsConfirm(true);
        $activity6->setIsOfficial(false);
        $activity6->setCreatedBy($this->getReference('user-jocv'));
        $manager->persist($activity6);
        
        // The other
        $activity7 = new Activity();
        $activity7->setName('School tour');
        $activity7->setVenue('Meet at reception');
        $activity7->setStarttime(new \DateTime('2016-12-21 13:00:00'));
        $activity7->setEndtime(new \DateTime('15:00:00'));
        $activity7->setTargets(array(
            OccupationChoiceLoader::OCCUPATION_THEOTHER_ID,
        ));
        $activity7->setIsConfirm(false);
        $activity7->setIsOfficial(false);
        $activity7->setCreatedBy($this->getReference('user-theother'));
        $manager->persist($activity7);
        
        // Student & teacher
        $activity8 = new Activity();
        $activity8->setName('Guidance about JICA');
        $activity8->setVenue('Meeting room A');
        $activity8->setStarttime(new \DateTime('2016-12-21 15:00:00'));
        $activity8->setEndtime(new \DateTime('16:00:00'));
        $activity8->setTargets(array(
            OccupationChoiceLoader::OCCUPATION_STUDENT_ID,
            OccupationChoiceLoader::OCCUPATION_TEACHER_ID,
        ));
        $activity8->setIsConfirm(true);
        $activity8->setIsOfficial(true);
        $activity8->setCreatedBy($this->getReference('user-super-admin'));
        $manager->persist($activity8);
        
        // Teacher, Deputy, Director
        $activity9 = new Activity();
        $activity9->setName('Review for the event');
        $activity9->setVenue('Multimedia room');
        $activity9->setStarttime(new \DateTime('2016-12-23 15:00:00'));
        $activity9->setEndtime(new \DateTime('16:00:00'));
        $activity9->setTargets(array( 
            OccupationChoiceLoader::OCCUPATION_TEACHER_ID, 
            OccupationChoiceLoader::OCCUPATION_DEPUTY_ID,
            OccupationChoiceLoader::OCCUPATION_DIRECTOR_ID,
        ));
        $activity9->setIsConfirm(false);
        $activity9->setIsOfficial(true);
        $activity9->setCreatedBy($this->getReference('user-super-admin'));
        $manager->persist($activity9);
        
        /* Inactive */
        // Official
        $activity10 = new Activity();
        $activity10->setName('Eve of Festival');
        $activity10->setVenue('Schoolyard');
        $activity10->setStarttime(new \DateTime('2016-12-20 18:00:00'));
        $activity10->setEndtime(new \DateTime('15:00:00'));
        $activity10->setTargets(array(
            OccupationChoiceLoader::OCCUPATION_STUDENT_ID, 
            OccupationChoiceLoader::OCCUPATION_TEACHER_ID, 
            OccupationChoiceLoader::OCCUPATION_DEPUTY_ID,
            OccupationChoiceLoader::OCCUPATION_DIRECTOR_ID,
            OccupationChoiceLoader::OCCUPATION_JOCV_ID,
            OccupationChoiceLoader::OCCUPATION_THEOTHER_ID
        ));
        $activity10->setIsConfirm(true);
        $activity10->setIsOfficial(true);
        $activity10->setIsActive(false);
        $activity10->setCreatedBy($this->getReference('user-super-admin'));
        $manager->persist($activity10);
        
        $activity11 = new Activity();
        $activity11->setName('Seeing Starlight');
        $activity11->setVenue('gymnasium');
        $activity11->setStarttime(new \DateTime('2016-12-21 13:00:00'));
        $activity11->setEndtime(new \DateTime('15:00:00'));
        $activity11->setTargets(array(
            OccupationChoiceLoader::OCCUPATION_STUDENT_ID, 
            OccupationChoiceLoader::OCCUPATION_TEACHER_ID, 
            OccupationChoiceLoader::OCCUPATION_DEPUTY_ID,
            OccupationChoiceLoader::OCCUPATION_DIRECTOR_ID,
            OccupationChoiceLoader::OCCUPATION_JOCV_ID,
            OccupationChoiceLoader::OCCUPATION_THEOTHER_ID
        ));
        $activity11->setIsConfirm(true);
        $activity11->setIsOfficial(false);
        $activity11->setIsActive(false);
        $activity11->setCreatedBy($this->getReference('user-user'));
        $manager->persist($activity11);
        
        $manager->flush();
        
        $this->addReference('activity-1', $activity1);
        $this->addReference('activity-2', $activity2);
        $this->addReference('activity-3', $activity3);

    }
    
    public function getOrder()
    {
        return 30;
    }
}
