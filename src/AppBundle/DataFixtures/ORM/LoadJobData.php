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
        $student->setName('Student');
        $manager->persist($student);
        
        /* Teacher */
        $teacher = new Job();
        $teacher->setName('Teacher');
        $manager->persist($teacher);
        
        $manager->flush();
        
        $this->addReference('Student', $student);
        $this->addReference('Teacher', $teacher);

    }
    
    public function getOrder()
    {
        return 3;
    }
}
