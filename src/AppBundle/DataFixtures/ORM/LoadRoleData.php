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
 * Description of LoadRoleData
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
        /* ROLE_USER */
        $roleUser = new Role();
        $roleUser->setId(1);
        $roleUser->setRole('ROLE_USER');        
        $manager->persist($roleUser);
        
        /* ROLE_ADMIN */
        $roleAdmin = new Role();
        $roleAdmin->setId(2);
        $roleAdmin->setRole('ROLE_ADMIN');
        $manager->persist($roleAdmin);
        
        /* ROLE_SUPER_ADMIN */
        $roleSAdmin = new Role();
        $roleSAdmin->setId(3);
        $roleSAdmin->setRole('ROLE_SUPER_ADMIN');        
        $manager->persist($roleSAdmin);
        
        $manager->flush();
        
        $this->addReference('role-user', $roleUser);
        $this->addReference('role-admin', $roleAdmin);
        $this->addReference('role-super-admin', $roleSAdmin);

    }
    
    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 1;
    }
}
