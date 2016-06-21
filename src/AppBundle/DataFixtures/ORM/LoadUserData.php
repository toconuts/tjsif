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
use AppBundle\Utils\ChoiceList\TitleChoiceLoader;
use AppBundle\Utils\ChoiceList\GenderChoiceLoader;
use AppBundle\Utils\ChoiceList\OccupationChoiceLoader;
use AppBundle\Utils\ChoiceList\AccountChoiceLoader;


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
    
    private $encoder;
    
    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
        $this->encoder = $this->container->get('security.password_encoder');
    }
    
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {   
        //$gender = (new Gender())->getChoices();
        //$title = (new Title)->getChoices();
        //$occupation = (new OccupationCategory)->getChoices();
        //$account = (new AccountType)->getChoices();
        
        $user1 = new User();
        $user1->setTitle(TitleChoiceLoader::TITLE_MR_ID);
        $user1->setFirstname('Marvin');
        $user1->setLastname('Knox');
        $user1->setPassword($this->encoder->encodePassword($user1, 'sadmin'));
        $user1->setEmail('sadmin@example.com');
        $user1->setIsActive(true);
        $user1 = $this->setRoles($user1, array('role-admin', 'role-super-admin'));
        $user1->setOrganization($this->getReference('org-8'));
        $user1->setOccupation(OccupationChoiceLoader::OCCUPATION_JOCV_ID);
        $user1->setGender(GenderChoiceLoader::GENDER_MALE_ID);
        $user1->setType(AccountChoiceLoader::ACCOUNT_PARTICIPANT_ID);
        $manager->persist($user1);
        
        $user2 = new User();
        $user2->setTitle(TitleChoiceLoader::TITLE_MS_ID);
        $user2->setFirstname('Dexter');
        $user2->setLastname('Blackwell');
        $user2->setPassword($this->encoder->encodePassword($user2, 'admin'));
        $user2->setEmail('admin@example.com');
        $user2->setIsActive(true);
        $user2 = $this->setRoles($user2, array('role-admin'));
        $user2->setOrganization($this->getReference('org-8'));
        $user2->setOccupation(OccupationChoiceLoader::OCCUPATION_TEACHER_ID);
        $user2->setGender(GenderChoiceLoader::GENDER_FEMALE_ID);
        $user2->setType(AccountChoiceLoader::ACCOUNT_PARTICIPANT_ID);
        $manager->persist($user2);
        
/*        
        $user3 = new User();
        $user3->setTitle(TitleChoiceLoader::TITLE_MR_ID);
        $user3->setFirstname('Marvin');
        $user3->setLastname('Knox');
        $user3->setPassword($this->encoder->encodePassword($user3, 'puser'));
        $user3->setEmail('puser@example.com');
        $user3->setIsActive(true);
        $user3 = $this->setRoles($user3, array('role-admin', 'role-super-admin'));
        $user3->setOrganization($this->getReference('org-8'));
        $user3->setOccupation(OccupationChoiceLoader::OCCUPATION_JOCV_ID);
        $user3->setGender(GenderChoiceLoader::GENDER_MALE_ID);
        $user3->setType(AccountChoiceLoader::ACCOUNT_PARTICIPANT_ID);
        $manager->persist($user3);
*/        
        $user4 = new User();
        $user4->setTitle(TitleChoiceLoader::TITLE_MR_ID);
        $user4->setFirstname('Theodore');
        $user4->setLastname('Frederick');
        $user4->setPassword($this->encoder->encodePassword($user4, 'user'));
        $user4->setEmail('user@example.com');
        $user4->setIsActive(true);
        $user4 = $this->setRoles($user4, array('role-admin', 'role-super-admin'));
        $user4->setOrganization($this->getReference('org-8'));
        $user4->setOccupation(OccupationChoiceLoader::OCCUPATION_STUDENT_ID);
        $user4->setGender(GenderChoiceLoader::GENDER_NS_ID);
        $user4->setType(AccountChoiceLoader::ACCOUNT_PARTICIPANT_ID);
        $manager->persist($user4);

/*        $sadmin = $this->createUser(
            '1',    // 'Mr.'
            'Marvin',
            'Knox',
            'sadmin@example.com',
            'sadmin', 
            true,
            [
                'role-admin',
                'role-super-admin',
            ],
            'org-8',
            'job-teacher',
            '1',  //Male
            '1'  //Participant
        );
        $manager->persist($sadmin);
        
        $admin = $this->createUser(
            '1',    // 'Mr.'
            'Dexter',
            'Blackwell',
            'admin@example.com',
            'admin', 
            true,
            [
                'role-admin',
            ],
            'org-20',
            'job-teacher',
            '2',  //Female
            '1'  //Participant
        );
        $manager->persist($admin);
        
        $user = $this->createUser(
            '2',  // 'Ms.'
            'Theodore',
            'Frederick',
            'user@example.com', 
            'user',
            true,
            [
                'role-user',
            ],
            'org-20',
            'job-student',
            '2',   //Female
            '1'   //Participant
        );
        
        $manager->persist($user);
        
        $manager->flush();
        
        $this->addReference('user-super-admin', $sadmin);
        $this->addReference('user-admin', $admin);
        $this->addReference('user-user', $user);*/
        
        $manager->flush();
        
        $this->addReference('user-super-admin', $user1);
        $this->addReference('user-admin', $user2);
//        $this->addReference('user-power-user', $user3);
        $this->addReference('user-user', $user4);
    }
    
    protected function setRoles(User $user, array $roles)
    {
        foreach ($roles as $roles) {
            $role = $this->getReference($roles);
            $user->addRole($role);
        }
        return $user;
    }
    
    /*protected function createUser(
        $title, 
        $firstname, 
        $lastname, 
        $email, 
        $password, 
        $isActive, 
        array $roles, 
        $organization, 
        $job,
        $gender,
        $type
        )
    {
        $user = new User();
        
        $user->setTitle($title);
        $user->setFirstname($firstname);
        $user->setLastname($lastname);
        $user->setPassword($encoder->encodePassword($user, $password));
        $user->setEmail($email);
        $user->setIsActive($isActive);
        foreach ($roles as $rolename) {
            $role = $this->getReference($rolename);
            $user->addRole($role);
        }
        $user->setOrganization($this->getReference($organization));
        $user->setJob($this->getReference($job));
        $user->setGender($gender);
        $user->setType($type);
        
        return $user;
    }*/
    
    public function getOrder()
    {
        return 10;
    }
}
