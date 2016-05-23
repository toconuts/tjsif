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
use AppBundle\Entity\Role;

/**
 * Description of LoadUserData
 *
 * @author toconuts <toconuts@gmail.com>
 */
class LoadRoleData extends AbstractFixture implements OrderedFixtureInterface
{
    
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        /* ROLE_ADMIN */
        $roleAdmin = new Role();
        $roleAdmin->setRole('ROLE_ADMIN');
        $manager->persist($roleAdmin);
        
        /* ROLE_SUPER_ADMIN */
        $roleSAdmin = new Role();
        $roleSAdmin->setRole('ROLE_SUPER_ADMIN');        
        $manager->persist($roleSAdmin);
        
        /* ROLE_USER */
        $roleUser = new Role();
        $roleUser->setRole('ROLE_USER');        
        $manager->persist($roleUser);
        
        $manager->flush();
        
        $this->addReference('ROLE_ADMIN', $roleAdmin);
        $this->addReference('ROLE_SUPER_ADMIN', $roleSAdmin);
        $this->addReference('ROLE_USER', $roleUser);

    }
    
    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 1;
    }
}
