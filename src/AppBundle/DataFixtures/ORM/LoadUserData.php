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
            'admin', 
            //'$2a$08$jHZj/wJfcVKlIwr5AvR78euJxYK7Ku5kURNhNx.7.CSIJ3Pq6LEPC', 
            'admin',
            'admin@example.com', 
            true,
            [
                'ROLE_ADMIN',
                'ROLE_SUPER_ADMIN',
            ]
        );
        $manager->persist($admin);
        
        $user = $this->createUser(
            'user', 
            //'$2a$08$jHZj/wJfcVKlIwr5AvR78euJxYK7Ku5kURNhNx.7.CSIJ3Pq6LEPC', 
            'user',
            'user@example.com', 
            true,
            [
                'ROLE_USER',
            ]
        );
        $manager->persist($user);
        
        $manager->flush();
    }
    
    protected function createUser($username, $password, $email, $isActive, array $roles)
    {
        $user = new User();
        $user->setUsername($username);
        //$user->setPassword($password);
        $encoder = $this->container->get('security.password_encoder');
        $password = $encoder->encodePassword($user, $password);
        $user->setPassword($password);
        $user->setEmail($email);
        $user->setIsActive($isActive);
//        $role = $this->getReference('ROLE_ADMIN');
        
        //$role = $this->getReference($roles);
        //$user->addRole($role);
        foreach ($roles as $rolaname) {
            $role = $this->getReference($rolaname);
            $user->addRole($role);
        }
        /*$em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('AppBundle:Role');
        foreach ($roles as $role) {
            $role = $repository->findOneBy(['name' => $role]);
            $user->addRole($role);
        }*/
        
        return $user;
    }
    
    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 2;
    }
}
