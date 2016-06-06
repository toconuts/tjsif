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
use AppBundle\Entity\Organization;

/**
 * Description of LoadOrganizationData
 *
 * @author toconuts <toconuts@gmail.com>
 */
class LoadOrganizationData extends AbstractFixture implements OrderedFixtureInterface
{
    
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        /* Chulabhorn Science High School Chonburi */
        $pcshs_chonburi = new Organization();
        $pcshs_chonburi->setId('1');
        $pcshs_chonburi->setName('Princess Churabhorn Science High School');
        $manager->persist($pcshs_chonburi);
        
        /* Ichikawa Gakuen */
        $jp_ichikawa = new Organization();
        $jp_ichikawa->setId('2');
        $jp_ichikawa->setName('Ichikawa Gakuen High School');
        $manager->persist($jp_ichikawa);
        
        $manager->flush();
        
        $this->addReference('PCSHS_Chonburi', $pcshs_chonburi);
        $this->addReference('JP_Ichikawa', $jp_ichikawa);

    }
    
    public function getOrder()
    {
        return 2;
    }
}
