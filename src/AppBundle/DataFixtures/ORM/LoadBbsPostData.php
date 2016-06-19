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
use AppBundle\Entity\BbsPost;

/**
 * Description of LoadBbsPostData
 *
 * @author toconuts <toconuts@gmail.com>
 */
class LoadBbsPostData extends AbstractFixture implements OrderedFixtureInterface
{
    
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $post1 = new BbsPost();
        $post1->setTitle('A day with Symfony2');
        $post1->setContent('Lorem ipsum dolor sit amet, consectetur adipiscing eletra electrify denim vel ports.\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi ut velocity magna. Etiam vehicula nunc non leo hendrerit commodo. Vestibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque. Nulla consectetur tempus nisl vitae viverra. Cras el mauris eget erat congue dapibus imperdiet justo scelerisque. Nulla consectetur tempus nisl vitae viverra. Cras elementum molestie vestibulum. Morbi id quam nisl. Praesent hendrerit, orci sed elementum lobortis, justo mauris lacinia libero, non facilisis purus ipsum non mi. Aliquam sollicitudin, augue id vestibulum iaculis, sem lectus convallis nunc, vel scelerisque lorem tortor ac nunc. Donec pharetra eleifend enim vel porta.');
        //$post1->setImage('beach.jpg');
        $post1->setUser($this->getReference('user-user'));
        $post1->setTags('symfony2, php, paradise, sympost');
        $post1->setCreatedAt(new \DateTime());
        $post1->setUpdatedAt($post1->getCreatedAt());
        $manager->persist($post1);

        $post2 = new BbsPost();
        $post2->setTitle('The pool on the roof must have a leak');
        $post2->setContent('Vestibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque. Na. Cras elementum molestie vestibulum. Morbi id quam nisl. Praesent hendrerit, orci sed elementum lobortis.');
        //$post2->setImage('pool_leak.jpg');
        $post2->setUser($this->getReference('user-user'));
        $post2->setTags('pool, leaky, hacked, movie, hacking, sympost');
        $post2->setCreatedAt(new \DateTime("2011-07-23 06:12:33"));
        $post2->setUpdatedAt($post2->getCreatedAt());
        $manager->persist($post2);

        $post3 = new BbsPost();
        $post3->setTitle('Misdirection. What the eyes see and the ears hear, the mind believes');
        $post3->setContent('Lorem ipsumvehicula nunc non leo hendrerit commodo. Vestibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque.');
        //$post3->setImage('misdirection.jpg');
        $post3->setUser($this->getReference('user-super-admin'));
        $post3->setTags('misdirection, magic, movie, hacking, sympost');
        $post3->setCreatedAt(new \DateTime("2011-07-16 16:14:06"));
        $post3->setUpdatedAt($post3->getCreatedAt());
        $manager->persist($post3);

        $post4 = new BbsPost();
        $post4->setTitle('The grid - A digital frontier');
        $post4->setContent('Lorem commodo. Vestibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque. Nulla consectetur tempus nisl vitae viverra.');
        //$post4->setImage('the_grid.jpg');
        $post4->setUser($this->getReference('user-user'));
        $post4->setTags('grid, daftpunk, movie, sympost');
        $post4->setCreatedAt(new \DateTime("2011-06-02 18:54:12"));
        $post4->setUpdatedAt($post4->getCreatedAt());
        $manager->persist($post4);

        $post5 = new BbsPost();
        $post5->setTitle('You\'re either a one or a zero. Alive or dead');
        $post5->setContent('Lorem ipsum dolor sit amet, consectetur adipiscing elittibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque.');
        //$post5->setImage('one_or_zero.jpg');
        $post5->setUser($this->getReference('user-admin'));
        $post5->setTags('binary, one, zero, alive, dead, !trusting, movie, sympost');
        $post5->setCreatedAt(new \DateTime("2011-04-25 15:34:18"));
        $post5->setUpdatedAt($post5->getCreatedAt());
        $manager->persist($post5);

        $manager->flush();
        
        $this->addReference('bbs-post1', $post1);
        $this->addReference('bbs-post2', $post2);
        $this->addReference('bbs-post3', $post3);
        $this->addReference('bbs-post4', $post4);
        $this->addReference('bbs-post5', $post2);
    }
    
    public function getOrder()
    {
        return 40;
    }
}
