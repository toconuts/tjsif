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
use AppBundle\Utils\ChoiceList\TopicChoiceLoader;
use AppBundle\Utils\ChoiceList\PresentationChoiceLoader;

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
        $project1 = new Project;
        $project1->setName('What is Lorem Ipsum?');
        $project1->setConcept('Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.');
        $project1->setObjective('The standard Lorem Ipsum passage, used since the 1500s');
        $project1->setTopic(TopicChoiceLoader::TITLE_APPLICATION_ID);
        $project1->setStyle(PresentationChoiceLoader::PRESENTATION_ORAL_ID);
        $project1->setOrganization($this->getReference('org-8'));
        $project1 = $this->setUsers($project1, array('user-super-admin'));
        $project1->setIsActive(true);
        $manager->persist($project1);
        
        $project2 = new Project;
        $project2->setName('Why do we use it?');
        $project2->setConcept('It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).');
        $project2->setObjective('Section 1.10.32 of "de Finibus Bonorum et Malorum", written by Cicero in 45 BC');
        $project2->setTopic(TopicChoiceLoader::TITLE_IOT_ID);
        $project2->setStyle(PresentationChoiceLoader::PRESENTATION_POSTER_ID);
        $project2->setOrganization($this->getReference('org-8'));
        $project2 = $this->setUsers($project2, array('user-super-admin', 'user-user'));
        $project2->setIsActive(true);
        $manager->persist($project2);
        
        $project3 = new Project;
        $project3->setName('Where does it come from?');
        $project3->setConcept('Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32. The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.');
        $project3->setObjective('Section 1.10.32 of "de Finibus Bonorum et Malorum", written by Cicero in 45 BC');
        $project3->setTopic(TopicChoiceLoader::TITLE_ROBOTICS_ID);
        $project3->setStyle(PresentationChoiceLoader::PRESENTATION_ORAL_ID);
        $project3->setOrganization($this->getReference('org-8'));
        $project3 = $this->setUsers($project3, array('user-super-admin', 'user-user'));
        $project3->setIsActive(true);
        $manager->persist($project3);
        
        $project4 = new Project;
        $project4->setName('Where can I get some?');
        $project4->setConcept('There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.');
        $project4->setObjective('Section 1.10.32 of "de Finibus Bonorum et Malorum", written by Cicero in 45 BC');
        $project4->setTopic(TopicChoiceLoader::TITLE_APPLICATION_ID);
        $project4->setStyle(PresentationChoiceLoader::PRESENTATION_POSTER_ID);
        $project4->setOrganization($this->getReference('org-8'));
        $project4 = $this->setUsers($project4, array('user-super-admin', 'user-admin', 'user-user'));
        $project4->setIsActive(false);
        $manager->persist($project4);
        
        $project5 = new Project;
        $project5->setName('The standard Lorem Ipsum passage, used since the 1500s');
        $project5->setConcept('Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.');
        $project5->setObjective('The standard Lorem Ipsum passage, used since the 1500s');
        $project5->setTopic(TopicChoiceLoader::TITLE_APPLICATION_ID);
        $project5->setStyle(PresentationChoiceLoader::PRESENTATION_ORAL_ID);
        $project5->setOrganization($this->getReference('org-1'));
        $project5 = $this->setUsers($project5, array('user-student'));
        $project5->setIsActive(true);
        $manager->persist($project5);
        
        $project6 = new Project;
        $project6->setName('Section 1.10.32 of "de Finibus Bonorum et Malorum", written by Cicero in 45 BC');
        $project6->setConcept('It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).');
        $project6->setObjective('Section 1.10.32 of "de Finibus Bonorum et Malorum", written by Cicero in 45 BC');
        $project6->setTopic(TopicChoiceLoader::TITLE_IOT_ID);
        $project6->setStyle(PresentationChoiceLoader::PRESENTATION_POSTER_ID);
        $project6->setOrganization($this->getReference('org-1'));
        $project6 = $this->setUsers($project6, array('user-student', 'user-teacher'));
        $project6->setIsActive(true);
        $manager->persist($project6);
        
        $project7 = new Project;
        $project7->setName('1914 translation by H. Rackham');
        $project7->setConcept('Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32. The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.');
        $project7->setObjective('Section 1.10.32 of "de Finibus Bonorum et Malorum", written by Cicero in 45 BC');
        $project7->setTopic(TopicChoiceLoader::TITLE_ROBOTICS_ID);
        $project7->setStyle(PresentationChoiceLoader::PRESENTATION_ORAL_ID);
        $project7->setOrganization($this->getReference('org-1'));
        $project7 = $this->setUsers($project7, array('user-student', 'user-deputy', 'user-director'));
        $project7->setIsActive(true);
        $manager->persist($project7);
        
        $project8 = new Project;
        $project8->setName('Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...');
        $project8->setConcept('There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.');
        $project8->setObjective('Section 1.10.32 of "de Finibus Bonorum et Malorum", written by Cicero in 45 BC');
        $project8->setTopic(TopicChoiceLoader::TITLE_APPLICATION_ID);
        $project8->setStyle(PresentationChoiceLoader::PRESENTATION_POSTER_ID);
        $project8->setOrganization($this->getReference('org-1'));
        $project8 = $this->setUsers($project8, array('user-student', 'user-theother'));
        $project8->setIsActive(false);
        $manager->persist($project8);
        
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

    public function getOrder()
    {
        return 20;
    }
}
