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
            'Mr.',
            'Fadmin',
            'Ladmin',
            'admin@example.com', 
            'admin', 
            true,
            [
                'ROLE_ADMIN',
                'ROLE_SUPER_ADMIN',
            ],
            'JP_Ichikawa',
            'Student'
        );
        $manager->persist($admin);
        
        $user = $this->createUser(
            'Ms.',
            'Fuser',
            'Luser',
            'user@example.com', 
            'user',
            true,
            [
                'ROLE_USER',
            ],
            'PCSHS_Chonburi',
            'Teacher'
        );
        $manager->persist($user);
        
        $manager->flush();
    }
    
    protected function createUser($title, $firstname, $lastname, $email, $password, $isActive, array $roles, $school, $job)
    {
        $user = new User();
        
        $encoder = $this->container->get('security.password_encoder');
        $user->setTitle($title);
        $user->setFirstname($firstname);
        $user->setLastname($lastname);
        $password = $encoder->encodePassword($user, $password);
        $user->setPassword($password);
        $user->setEmail($email);
        $user->setIsActive($isActive);
        foreach ($roles as $rolaname) {
            $role = $this->getReference($rolaname);
            $user->addRole($role);
        }
        $user->setSchool($this->getReference($school));
        $user->setJob($this->getReference($job));
        return $user;
    }
    
    public function getOrder()
    {
        return 5;
    }
}
