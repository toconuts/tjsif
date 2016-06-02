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
        $student->setRole($this->getReference('ROLE_USER'));
        $manager->persist($student);
        
        /* Teacher */
        $teacher = new Job();
        $teacher->setId(2);
        $teacher->setName('Teacher');
        $teacher->setRole($this->getReference('ROLE_ADMIN'));
        $manager->persist($teacher);
        
        /* Deputy */
        $duputy = new Job();
        $duputy->setId(3);
        $duputy->setName('Deputy / Vice principal');
        $duputy->setRole($this->getReference('ROLE_USER'));
        $manager->persist($duputy);
        
        /* Director */
        $director = new Job();
        $director->setId(4);
        $director->setName('Director / Principal');
        $director->setRole($this->getReference('ROLE_USER'));
        $manager->persist($director);
        
        /* JOCV */
        $jocv = new Job();
        $jocv->setId(5);
        $jocv->setName('JOCV');
        $jocv->setRole($this->getReference('ROLE_ADMIN'));
        $manager->persist($jocv);
        
        /* The other */
        $other = new Job();
        $other->setId(6);
        $other->setName('The other');
        $other->setRole($this->getReference('ROLE_USER'));
        $manager->persist($other);
        
        $manager->flush();
        
        $this->addReference('Student', $student);
        $this->addReference('Teacher', $teacher);
        $this->addReference('Deputy', $duputy);
        $this->addReference('Director', $director);
        $this->addReference('JOCV', $jocv);
        $this->addReference('Other', $other);

    }
    
    public function getOrder()
    {
        return 3;
    }
}
