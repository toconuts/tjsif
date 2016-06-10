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
use AppBundle\Entity\Program;

/**
 * Description of LoadProgramData
 *
 * @author toconuts <toconuts@gmail.com>
 */
class LoadProgramData extends AbstractFixture implements OrderedFixtureInterface
{
    
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        /* Program 1 */
        $program1 = $this->createProgram(
                '1', 
                'Program number 1', 
                new \DateTime('2016-12-21 13:00:00'));
        $manager->persist($program1);
        
        /* Program 2 */
        $program2 = $this->createProgram(
                '2', 
                'Program number 2 - **************************************', 
                new \DateTime('2016-12-21 15:00:00'));
        $manager->persist($program2);
        
        /* Program 3 */
        $program3 = $this->createProgram(
                '3', 
                'Program number 3 - Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh.', 
                new \DateTime('2016-12-21 17:00:00'));
        $manager->persist($program3);
        
        $manager->flush();
        
        $this->addReference('Program_1', $program1);
        $this->addReference('Program_2', $program2);
        $this->addReference('Program_3', $program3);

    }
    
    protected function createProgram($id, $name, $date)
    {
        $program = new Program();
        $program->setId($id);
        $program->setName($name);
        $program->setDate($date);
        return $program;
    }


    public function getOrder()
    {
        return 4;
    }
}
