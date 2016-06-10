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
        $sadmin = $this->createUser(
            '1',    // 'Mr.'
            'Marvin',
            'Knox',
            'sadmin@example.com',
            'sadmin', 
            true,
            [
                'role-admin',
                'role-super-admin',
            ],
            'pcshs-chonburi',
            'job-teacher',
            '1',  //Male
            '1'  //Participant
        );
        $manager->persist($sadmin);
        
        $admin = $this->createUser(
            '1',    // 'Mr.'
            'Dexter',
            'Blackwell',
            'admin@example.com',
            'admin', 
            true,
            [
                'role-admin',
            ],
            'jp-ichikawa',
            'job-teacher',
            '2',  //Female
            '1'  //Participant
        );
        $manager->persist($admin);
        
        $user = $this->createUser(
            '2',  // 'Ms.'
            'Theodore',
            'Frederick',
            'user@example.com', 
            'user',
            true,
            [
                'role-user',
            ],
            'jp-ichikawa',
            'job-student',
            '2',   //Female
            '1'   //Participant
        );
        $manager->persist($user);
        
        $manager->flush();
        
        $this->addReference('user-super-admin', $admin);
        $this->addReference('user-admin', $admin);
        $this->addReference('user-user', $user);
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
        $type
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
        
        return $user;
    }
    
    public function getOrder()
    {
        return 10;
    }
}
