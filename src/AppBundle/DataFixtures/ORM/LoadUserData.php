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
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use AppBundle\Entity\User;

/**
 * Description of LoadUserData
 *
 * @author toconuts <toconuts@gmail.com>
 */
class LoadUserData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;
    
    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
    
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $admin = $this->createUser(
            '1',    // 'Mr.'
            'Fadmin',
            'Ladmin',
            'admin@example.com',
            'admin', 
            true,
            [
                'ROLE_ADMIN',
                'ROLE_SUPER_ADMIN',
            ],
            'PCSHS_Chonburi',
            'Teacher',
            '1',  //Male
            '1',  //Participant
            array()
        );
        $manager->persist($admin);
        
        $user = $this->createUser(
            '2',  // 'Ms.'
            'Fuser',
            'Luser',
            'user@example.com', 
            'user',
            true,
            [
                'ROLE_USER',
            ],
            'JP_Ichikawa',
            'Student',
            '2',   //Female
            '1',   //Participant
            array('Project_1', 'Project_2')
        );
        $manager->persist($user);
        
        $manager->flush();
        
        $this->addReference('USER_ADMIN', $admin);
        $this->addReference('USER_USER', $user);
    }
    
    protected function createUser(
        $title, 
        $firstname, 
        $lastname, 
        $email, 
        $password, 
        $isActive, 
        array $roles, 
        $organization, 
        $job,
        $gender,
        $type,
        array $projects
        )
    {
        $user = new User();
        
        $encoder = $this->container->get('security.password_encoder');
        $user->setTitle($title);
        $user->setFirstname($firstname);
        $user->setLastname($lastname);
        $user->setPassword($encoder->encodePassword($user, $password));
        $user->setEmail($email);
        $user->setIsActive($isActive);
        foreach ($roles as $rolename) {
            $role = $this->getReference($rolename);
            $user->addRole($role);
        }
        $user->setOrganization($this->getReference($organization));
        $user->setJob($this->getReference($job));
        $user->setGender($gender);
        $user->setType($type);
        foreach ($projects as $project) {
            $user->addProject($this->getReference($project));
        }
        return $user;
    }
    
    public function getOrder()
    {
        return 10;
    }
}
