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
use AppBundle\Entity\Project;

/**
 * Description of LoadProjectData
 *
 * @author toconuts <toconuts@gmail.com>
 */
class LoadProjectData extends AbstractFixture implements OrderedFixtureInterface
{
    
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        
        
        /* Project 1 */
        $project1 = $this->createProject(
            'Project name 1',
            true,
            $this->getReference('JP_Ichikawa')
        );
        $manager->persist($project1);
        
        /* Project 2 */
        $project2 = $this->createProject(
            'Project name 2',
            true,
            $this->getReference('JP_Ichikawa')
        );
        $manager->persist($project2);
        
        $manager->flush();
        
        $this->addReference('Project_1', $project1);
        $this->addReference('Project_2', $project2);
    }
    
    protected function createProject($name, $isActive, $organization)
    {
        $project = new Project;
        $project->setName($name);
        $project->setIsActive($isActive);
        $project->setOrganization($organization);

        return $project;
    }


    public function getOrder()
    {
        return 9;
    }
}
