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
use AppBundle\Entity\Job;

/**
 * Description of LoadJobData
 *
 * @author toconuts <toconuts@gmail.com>
 */
class LoadJobData extends AbstractFixture implements OrderedFixtureInterface
{
    
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        /* Student */
        $student = new Job();
        $student->setId(1);
        $student->setName('Student');
        $student->setRole($this->getReference('role-user'));
        $manager->persist($student);
        
        /* Teacher */
        $teacher = new Job();
        $teacher->setId(2);
        $teacher->setName('Teacher');
        $teacher->setRole($this->getReference('role-admin'));
        $manager->persist($teacher);
        
        /* Deputy */
        $duputy = new Job();
        $duputy->setId(3);
        $duputy->setName('Deputy / Vice principal');
        $duputy->setRole($this->getReference('role-user'));
        $manager->persist($duputy);
        
        /* Director */
        $director = new Job();
        $director->setId(4);
        $director->setName('Director / Principal');
        $director->setRole($this->getReference('role-user'));
        $manager->persist($director);
        
        /* JOCV */
        $jocv = new Job();
        $jocv->setId(5);
        $jocv->setName('JOCV');
        $jocv->setRole($this->getReference('role-admin'));
        $manager->persist($jocv);
        
        /* The other */
        $other = new Job();
        $other->setId(6);
        $other->setName('The other');
        $other->setRole($this->getReference('role-user'));
        $manager->persist($other);
        
        $manager->flush();
        
        $this->addReference('job-student', $student);
        $this->addReference('job-teacher', $teacher);
        $this->addReference('job-deputy', $duputy);
        $this->addReference('job-director', $director);
        $this->addReference('job-jocv', $jocv);
        $this->addReference('job-other', $other);

    }
    
    public function getOrder()
    {
        return 3;
    }
}
