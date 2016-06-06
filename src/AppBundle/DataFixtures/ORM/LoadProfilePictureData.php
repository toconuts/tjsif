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
use AppBundle\Entity\ProfilePicture;

/**
 * Description of LoadProfilePictureData
 *
 * @author toconuts <toconuts@gmail.com>
 */
class LoadProfilePictureData extends AbstractFixture implements OrderedFixtureInterface
{
    
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        
        $picture1 = new ProfilePicture();
        $picture1->setImageName('initial_user.png');
        $picture1->setUser($this->getReference('USER_ADMIN'));
        $manager->persist($picture1);
        
        $picture2 = new ProfilePicture();
        $picture2->setImageName('initial_user.png');
        $picture2->setUser($this->getReference('USER_USER'));
        $manager->persist($picture2);
        
        $manager->flush();
        
        $this->addReference('Picture1', $picture1);
        $this->addReference('Picture2', $picture2);
        
    }
    
    public function getOrder()
    {
        return 15;
    }
}
