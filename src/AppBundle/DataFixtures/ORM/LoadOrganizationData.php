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
        $pcshs_chonburi = $this->createOrganization(
            'Princess Churabhorn Science High School Chonburi',
            'PCSHS Chonburi',
            'TH',
            '1', // School
            array()
        );
        $manager->persist($pcshs_chonburi);
        $this->addReference('pcshs-chonburi', $pcshs_chonburi);
        
        /* Ichikawa Gakuen */
        $jp_ichikawa = $this->createOrganization(
            'Ichikawa Gakuen High School',
            'Ichigaku',
            'JP',
            '1', // School
            array (
                'pcshs-chonburi',
            )
        );
        $manager->persist($jp_ichikawa);
        $this->addReference('jp-ichikawa', $jp_ichikawa);
        
        $manager->flush();
    }
    
    public function createOrganization($name, $shortname, $country, $type, array $sisters)
    {
        $organization = new Organization();
        $organization->setName($name);
        $organization->setShortname($shortname);
        $organization->setCountry($country);
        $organization->setType($type);
        foreach ($sisters as $sister) {
            $organization->addSister($this->getReference($sister));
        }
        return $organization;
    }
    
    public function getOrder()
    {
        return 2;
    }
}
