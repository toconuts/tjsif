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
use AppBundle\Entity\BbsComment;

/**
 * Description of LoadBbsCommentData
 *
 * @author toconuts <toconuts@gmail.com>
 */
class LoadBbsCommentData extends AbstractFixture implements OrderedFixtureInterface
{
    
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $comment = new BbsComment();
        $comment->setUser($this->getReference('user-super-admin'));
        $comment->setContent('To make a long story short. You can\'t go wrong by choosing Symfony! And no one has ever been fired for using Symfony.');
        $comment->setPost($this->getReference('bbs-post1'));
        $comment->setCreatedAt(new \DateTime("2011-07-21 06:15:20"));
        $comment->setUpdatedAt($comment->getCreatedAt());
        $manager->persist($comment);

        $comment = new BbsComment();
        $comment->setUser($this->getReference('user-super-admin'));
        $comment->setContent('To make a long story short. Choosing a framework must not be taken lightly; it is a long-term commitment. Make sure that you make the right selection!');
        $comment->setPost($this->getReference('bbs-post1'));
        $comment->setCreatedAt(new \DateTime("2011-07-20 06:15:20"));
        $comment->setUpdatedAt($comment->getCreatedAt());
        $manager->persist($comment);

        $comment = new BbsComment();
        $comment->setUser($this->getReference('user-admin'));
        $comment->setContent('Anything else, mom? You want me to mow the lawn? Oops! I forgot, New York, No grass.');
        $comment->setPost($this->getReference('bbs-post2'));
        $comment->setCreatedAt(new \DateTime("2011-07-22 06:15:20"));
        $comment->setUpdatedAt($comment->getCreatedAt());
        $manager->persist($comment);

        $comment = new BbsComment();
        $comment->setUser($this->getReference('user-user'));
        $comment->setContent('Are you challenging me? ');
        $comment->setPost($this->getReference('bbs-post2'));
        $comment->setCreatedAt(new \DateTime("2011-07-23 06:15:20"));
        $comment->setUpdatedAt($comment->getCreatedAt());
        $manager->persist($comment);

        $comment = new BbsComment();
        $comment->setUser($this->getReference('user-admin'));
        $comment->setContent('Name your stakes.');
        $comment->setPost($this->getReference('bbs-post2'));
        $comment->setCreatedAt(new \DateTime("2011-07-23 06:18:35"));
        $comment->setUpdatedAt($comment->getCreatedAt());
        $manager->persist($comment);

        $comment = new BbsComment();
        $comment->setUser($this->getReference('user-user'));
        $comment->setContent('If I win, you become my slave.');
        $comment->setPost($this->getReference('bbs-post2'));
        $comment->setCreatedAt(new \DateTime("2011-07-23 06:22:53"));
        $comment->setUpdatedAt($comment->getCreatedAt());
        $manager->persist($comment);

        $comment = new BbsComment();
        $comment->setUser($this->getReference('user-admin'));
        $comment->setContent('Your SLAVE?');
        $comment->setPost($this->getReference('bbs-post2'));
        $comment->setCreatedAt(new \DateTime("2011-07-23 06:25:15"));
        $comment->setUpdatedAt($comment->getCreatedAt());
        $manager->persist($comment);

        $comment = new BbsComment();
        $comment->setUser($this->getReference('user-user'));
        $comment->setContent('You wish! You\'ll do shitwork, scan, crack copyrights...');
        $comment->setPost($this->getReference('bbs-post2'));
        $comment->setCreatedAt(new \DateTime("2011-07-23 06:46:08"));
        $comment->setUpdatedAt($comment->getCreatedAt());
        $manager->persist($comment);

        $comment = new BbsComment();
        $comment->setUser($this->getReference('user-admin'));
        $comment->setContent('And if I win?');
        $comment->setPost($this->getReference('bbs-post2'));
        $comment->setCreatedAt(new \DateTime("2011-07-23 10:22:46"));
        $comment->setUpdatedAt($comment->getCreatedAt());
        $manager->persist($comment);

        $comment = new BbsComment();
        $comment->setUser($this->getReference('user-user'));
        $comment->setContent('Make it my first-born!');
        $comment->setPost($this->getReference('bbs-post2'));
        $comment->setCreatedAt(new \DateTime("2011-07-23 11:08:08"));
        $comment->setUpdatedAt($comment->getCreatedAt());
        $manager->persist($comment);

        $comment = new BbsComment();
        $comment->setUser($this->getReference('user-admin'));
        $comment->setContent('Make it our first-date!');
        $comment->setPost($this->getReference('bbs-post2'));
        $comment->setCreatedAt(new \DateTime("2011-07-24 18:56:01"));
        $comment->setUpdatedAt($comment->getCreatedAt());
        $manager->persist($comment);

        $comment = new BbsComment();
        $comment->setUser($this->getReference('user-user'));
        $comment->setContent('I don\'t DO dates. But I don\'t lose either, so you\'re on!');
        $comment->setPost($this->getReference('bbs-post2'));
        $comment->setCreatedAt(new \DateTime("2011-07-25 22:28:42"));
        $comment->setUpdatedAt($comment->getCreatedAt());
        $manager->persist($comment);

        $comment = new BbsComment();
        $comment->setUser($this->getReference('user-super-admin'));
        $comment->setContent('It\'s not gonna end like this.');
        $comment->setPost($this->getReference('bbs-post3'));
        $comment->setCreatedAt(new \DateTime("2011-07-23 06:15:20"));
        $comment->setUpdatedAt($comment->getCreatedAt());
        $manager->persist($comment);

        $comment = new BbsComment();
        $comment->setUser($this->getReference('user-admin'));
        $comment->setContent('Oh, come on, Stan. Not everything ends the way you think it should. Besides, audiences love happy endings.');
        $comment->setPost($this->getReference('bbs-post3'));
        $comment->setCreatedAt(new \DateTime("2011-07-24 06:15:20"));
        $comment->setUpdatedAt($comment->getCreatedAt());
        $manager->persist($comment);

        $comment = new BbsComment();
        $comment->setUser($this->getReference('user-user'));
        $comment->setContent('Doesn\'t Bill Gates have something like that?');
        $comment->setPost($this->getReference('bbs-post5'));
        $comment->setCreatedAt(new \DateTime("2011-07-22 06:15:20"));
        $comment->setUpdatedAt($comment->getCreatedAt());
        $manager->persist($comment);

        $comment = new BbsComment();
        $comment->setUser($this->getReference('user-super-admin'));
        $comment->setContent('Bill Who?');
        $comment->setPost($this->getReference('bbs-post5'));
        $comment->setCreatedAt(new \DateTime("2011-07-23 06:15:20"));
        $comment->setUpdatedAt($comment->getCreatedAt());
        $manager->persist($comment);
        
        $manager->flush();
        
    }
    
    public function getOrder()
    {
        return 41;
    }
}
