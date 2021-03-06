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
        
        /* ROLE_POWER_USER */
        $rolePUser = new Role();
        $rolePUser->setId(2);
        $rolePUser->setRole('ROLE_POWER_USER');        
        $manager->persist($rolePUser);
        
        /* ROLE_ADMIN */
        $roleAdmin = new Role();
        $roleAdmin->setId(3);
        $roleAdmin->setRole('ROLE_ADMIN');
        $manager->persist($roleAdmin);
        
        /* ROLE_SUPER_ADMIN */
        $roleSAdmin = new Role();
        $roleSAdmin->setId(4);
        $roleSAdmin->setRole('ROLE_SUPER_ADMIN');        
        $manager->persist($roleSAdmin);
        
        $manager->flush();
        
        $this->addReference('role-user',        $roleUser);
        $this->addReference('role-power-user',  $rolePUser);
        $this->addReference('role-admin',       $roleAdmin);
        $this->addReference('role-super-admin', $roleSAdmin);

    }
    
    public function getOrder()
    {
        return 1;
    }
}
