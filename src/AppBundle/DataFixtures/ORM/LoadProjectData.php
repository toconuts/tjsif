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
use AppBundle\Utils\ChoiceList\Topic;
use AppBundle\Utils\ChoiceList\PresentationStyle;

/**
 * Description of LoadProjectData
 *
 * @author toconuts <toconuts@gmail.com>
 */
class LoadProjectData extends AbstractFixture implements OrderedFixtureInterface
{
    /* Topics */
    const APPLICATION = 'Application / Software';
    const Robotics = 'Robotics / Hardware';
    const IOT = 'Internet of Thing (IoT)';
    
    /* Style */
    const ORAL = 'Oral';
    const POSTER = 'Poster';
    
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        
        $topics = (new Topic())->getChoices();
        $style = (new PresentationStyle())->getChoices();
        
        $project1 = new Project;
        $project1->setName('What is Lorem Ipsum?');
        $project1->setConcept('Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.');
        $project1->setObjective('The standard Lorem Ipsum passage, used since the 1500s');
        $project1->setTopic($topics[self::APPLICATION]);
        $project1->setStyle($style[self::ORAL]);
        $project1->setOrganization($this->getReference('org-8'));
        $project1 = $this->setUsers($project1, array('user-user', 'user-admin'));
        $project1->setIsActive(true);
        $manager->persist($project1);
        
        $project2 = new Project;
        $project2->setName('Why do we use it?');
        $project2->setConcept('It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).');
        $project2->setObjective('Section 1.10.32 of "de Finibus Bonorum et Malorum", written by Cicero in 45 BC');
        $project2->setTopic($topics[self::IOT]);
        $project2->setStyle($style[self::ORAL]);
        $project2->setOrganization($this->getReference('org-8'));
        $project2 = $this->setUsers($project2, ['user-user', 'user-admin']);
        $project2->setIsActive(true);
        $manager->persist($project2);
        
        $project3 = new Project;
        $project3->setName('Where does it come from?');
        $project3->setConcept('Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32. The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.');
        $project3->setObjective('Section 1.10.32 of "de Finibus Bonorum et Malorum", written by Cicero in 45 BC');
        $project3->setTopic($topics[self::Robotics]);
        $project3->setStyle($style[self::POSTER]);
        $project3->setOrganization($this->getReference('org-8'));
        $project3 = $this->setUsers($project3, ['user-user', 'user-admin']);
        $project3->setIsActive(true);
        $manager->persist($project3);
        
        $project4 = new Project;
        $project4->setName('Where can I get some?');
        $project4->setConcept('There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.');
        $project4->setObjective('Section 1.10.32 of "de Finibus Bonorum et Malorum", written by Cicero in 45 BC');
        $project4->setTopic($topics[self::APPLICATION]);
        $project4->setStyle($style[self::POSTER]);
        $project4->setOrganization($this->getReference('org-8'));
        $project4 = $this->setUsers($project4, ['user-user', 'user-admin']);
        $project4->setIsActive(false);
        $manager->persist($project4);
        
        /* Project 1
        $project1 = $this->createProject(
            'Project name 1',
            true,
            1,
            1,
            $this->getReference('org-20'),
            [
                'user-user',
                'user-admin',
            ]
        );
        $manager->persist($project1);*/
        
        /* Project 2 
        $project2 = $this->createProject(
            'Project name 2',
            true,
            2,
            2,
            $this->getReference('org-20'),
            [
                'user-user',
            ]
        );
        $manager->persist($project2);*/
        
        $manager->flush();
        
        $this->addReference('project-1', $project1);
        $this->addReference('project-2', $project2);
        $this->addReference('project-3', $project3);
        $this->addReference('project-4', $project4);
    }
    
    protected function setUsers(Project $project, $users) {
        foreach ($users as $user) {
            $project->addUser($this->getReference($user));
        }
        return $project;
    }


    protected function createProject($name, $isActive, $topic, $style, $organization, $users)
    {
        $project = new Project;
        $project->setName($name);
        $project->setIsActive($isActive);
        $project->setTopic($topic);
        $project->setStyle($style);
        $project->setOrganization($organization);
        foreach ($users as $user) {
            $project->addUser($this->getReference($user));
        }

        return $project;
    }


    public function getOrder()
    {
        return 20;
    }
}
