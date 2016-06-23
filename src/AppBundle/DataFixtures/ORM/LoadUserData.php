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
    
    /**
     * @var UserPasswordEncoder
     */
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
        /*--- Roles ---*/
        // Role SAdmin
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
        
        // Role Admin
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
        
        // Role PUser
        $user3 = new User();
        $user3->setTitle(TitleChoiceLoader::TITLE_MRS_ID);
        $user3->setFirstname('Ranpo');
        $user3->setLastname('Edogawa');
        $user3->setPassword($this->encoder->encodePassword($user3, 'puser'));
        $user3->setEmail('puser@example.com');
        $user3->setIsActive(true);
        $user3 = $this->setRoles($user3, array('role-power-user'));
        $user3->setOrganization($this->getReference('org-25'));
        $user3->setOccupation(OccupationChoiceLoader::OCCUPATION_THEOTHER_ID);
        $user3->setGender(GenderChoiceLoader::GENDER_NS_ID);
        $user3->setType(AccountChoiceLoader::ACCOUNT_PARTICIPANT_ID);
        $manager->persist($user3);
        
        // Role User
        $user4 = new User();
        $user4->setTitle(TitleChoiceLoader::TITLE_MISS_ID);
        $user4->setFirstname('Theodore');
        $user4->setLastname('Frederick');
        $user4->setPassword($this->encoder->encodePassword($user4, 'user'));
        $user4->setEmail('user@example.com');
        $user4->setIsActive(true);
        $user4 = $this->setRoles($user4, array('role-user'));
        $user4->setOrganization($this->getReference('org-8'));
        $user4->setOccupation(OccupationChoiceLoader::OCCUPATION_STUDENT_ID);
        $user4->setGender(GenderChoiceLoader::GENDER_MALE_ID);
        $user4->setType(AccountChoiceLoader::ACCOUNT_PARTICIPANT_ID);
        $manager->persist($user4);
        
        
        /*--- Occupations (6 kind) ---*/
        // Student
        $user5 = new User();
        $user5->setTitle(TitleChoiceLoader::TITLE_DR_ID);
        $user5->setFirstname('Occupation');
        $user5->setLastname('Student');
        $user5->setPassword($this->encoder->encodePassword($user5, 'user01'));
        $user5->setEmail('user01@example.com');
        $user5->setIsActive(true);
        $user5 = $this->setRoles($user5, array('role-user'));
        $user5->setOrganization($this->getReference('org-1'));
        $user5->setOccupation(OccupationChoiceLoader::OCCUPATION_STUDENT_ID);
        $user5->setGender(GenderChoiceLoader::GENDER_FEMALE_ID);
        $user5->setType(AccountChoiceLoader::ACCOUNT_PARTICIPANT_ID);
        $manager->persist($user5);
        
        // Teacher
        $user6 = new User();
        $user6->setTitle(TitleChoiceLoader::TITLE_MR_ID);
        $user6->setFirstname('Occupation');
        $user6->setLastname('Teacher');
        $user6->setPassword($this->encoder->encodePassword($user6, 'user02'));
        $user6->setEmail('user02@example.com');
        $user6->setIsActive(true);
        $user6 = $this->setRoles($user6, array('role-admin'));
        $user6->setOrganization($this->getReference('org-1'));
        $user6->setOccupation(OccupationChoiceLoader::OCCUPATION_TEACHER_ID);
        $user6->setGender(GenderChoiceLoader::GENDER_NS_ID);
        $user6->setType(AccountChoiceLoader::ACCOUNT_PARTICIPANT_ID);
        $manager->persist($user6);
        
        // Deputy
        $user7 = new User();
        $user7->setTitle(TitleChoiceLoader::TITLE_MS_ID);
        $user7->setFirstname('Occupation');
        $user7->setLastname('Deputy');
        $user7->setPassword($this->encoder->encodePassword($user7, 'user03'));
        $user7->setEmail('user03@example.com');
        $user7->setIsActive(true);
        $user7 = $this->setRoles($user7, array('role-user'));
        $user7->setOrganization($this->getReference('org-1'));
        $user7->setOccupation(OccupationChoiceLoader::OCCUPATION_DEPUTY_ID);
        $user7->setGender(GenderChoiceLoader::GENDER_MALE_ID);
        $user7->setType(AccountChoiceLoader::ACCOUNT_PARTICIPANT_ID);
        $manager->persist($user7);
        
        // Director
        $user8 = new User();
        $user8->setTitle(TitleChoiceLoader::TITLE_MRS_ID);
        $user8->setFirstname('Occupation');
        $user8->setLastname('Director');
        $user8->setPassword($this->encoder->encodePassword($user8, 'user04'));
        $user8->setEmail('user04@example.com');
        $user8->setIsActive(true);
        $user8 = $this->setRoles($user8, array('role-user'));
        $user8->setOrganization($this->getReference('org-1'));
        $user8->setOccupation(OccupationChoiceLoader::OCCUPATION_DIRECTOR_ID);
        $user8->setGender(GenderChoiceLoader::GENDER_FEMALE_ID);
        $user8->setType(AccountChoiceLoader::ACCOUNT_PARTICIPANT_ID);
        $manager->persist($user8);
        
        // JOCV
        $user9 = new User();
        $user9->setTitle(TitleChoiceLoader::TITLE_MISS_ID);
        $user9->setFirstname('Occupation');
        $user9->setLastname('JOCV');
        $user9->setPassword($this->encoder->encodePassword($user9, 'user05'));
        $user9->setEmail('user05@example.com');
        $user9->setIsActive(true);
        $user9 = $this->setRoles($user9, array('role-admin'));
        $user9->setOrganization($this->getReference('org-1'));
        $user9->setOccupation(OccupationChoiceLoader::OCCUPATION_JOCV_ID);
        $user9->setGender(GenderChoiceLoader::GENDER_NS_ID);
        $user9->setType(AccountChoiceLoader::ACCOUNT_PARTICIPANT_ID);
        $manager->persist($user9);
        
        // The Other
        $user10 = new User();
        $user10->setTitle(TitleChoiceLoader::TITLE_DR_ID);
        $user10->setFirstname('Occupation');
        $user10->setLastname('The other');
        $user10->setPassword($this->encoder->encodePassword($user10, 'user06'));
        $user10->setEmail('user06@example.com');
        $user10->setIsActive(true);
        $user10 = $this->setRoles($user10, array('role-user'));
        $user10->setOrganization($this->getReference('org-1'));
        $user10->setOccupation(OccupationChoiceLoader::OCCUPATION_THEOTHER_ID);
        $user10->setGender(GenderChoiceLoader::GENDER_MALE_ID);
        $user10->setType(AccountChoiceLoader::ACCOUNT_PARTICIPANT_ID);
        $manager->persist($user10);
        
        /*--- Organization ---*/
        // High school
        $user11 = new User();
        $user11->setTitle(TitleChoiceLoader::TITLE_DR_ID);
        $user11->setFirstname('Organization');
        $user11->setLastname('Highschool');
        $user11->setPassword($this->encoder->encodePassword($user11, 'user11'));
        $user11->setEmail('user11@example.com');
        $user11->setIsActive(true);
        $user11 = $this->setRoles($user11, array('role-user'));
        $user11->setOrganization($this->getReference('org-9'));
        $user11->setOccupation(OccupationChoiceLoader::OCCUPATION_STUDENT_ID);
        $user11->setGender(GenderChoiceLoader::GENDER_FEMALE_ID);
        $user11->setType(AccountChoiceLoader::ACCOUNT_PARTICIPANT_ID);
        $manager->persist($user11);
        
        // University
        $user12 = new User();
        $user12->setTitle(TitleChoiceLoader::TITLE_DR_ID);
        $user12->setFirstname('Organization');
        $user12->setLastname('University');
        $user12->setPassword($this->encoder->encodePassword($user12, 'user12'));
        $user12->setEmail('user12@example.com');
        $user12->setIsActive(true);
        $user12 = $this->setRoles($user12, array('role-user'));
        $user12->setOrganization($this->getReference('org-25'));
        $user12->setOccupation(OccupationChoiceLoader::OCCUPATION_STUDENT_ID);
        $user12->setGender(GenderChoiceLoader::GENDER_NS_ID);
        $user12->setType(AccountChoiceLoader::ACCOUNT_PARTICIPANT_ID);
        $manager->persist($user12);
        
        // Government
        $user13 = new User();
        $user13->setTitle(TitleChoiceLoader::TITLE_DR_ID);
        $user13->setFirstname('Organization');
        $user13->setLastname('Government');
        $user13->setPassword($this->encoder->encodePassword($user13, 'user13'));
        $user13->setEmail('user13@example.com');
        $user13->setIsActive(true);
        $user13 = $this->setRoles($user13, array('role-user'));
        $user13->setOrganization($this->getReference('org-26'));
        $user13->setOccupation(OccupationChoiceLoader::OCCUPATION_THEOTHER_ID);
        $user13->setGender(GenderChoiceLoader::GENDER_MALE_ID);
        $user13->setType(AccountChoiceLoader::ACCOUNT_PARTICIPANT_ID);
        $manager->persist($user13);
        
        // Company
        $user14 = new User();
        $user14->setTitle(TitleChoiceLoader::TITLE_DR_ID);
        $user14->setFirstname('Organization');
        $user14->setLastname('Company');
        $user14->setPassword($this->encoder->encodePassword($user14, 'user14'));
        $user14->setEmail('user14@example.com');
        $user14->setIsActive(true);
        $user14 = $this->setRoles($user14, array('role-user'));
        $user14->setOrganization($this->getReference('org-27'));
        $user14->setOccupation(OccupationChoiceLoader::OCCUPATION_THEOTHER_ID);
        $user14->setGender(GenderChoiceLoader::GENDER_FEMALE_ID);
        $user14->setType(AccountChoiceLoader::ACCOUNT_PARTICIPANT_ID);
        $manager->persist($user14);
        
        // The other
        $user15 = new User();
        $user15->setTitle(TitleChoiceLoader::TITLE_DR_ID);
        $user15->setFirstname('Organization');
        $user15->setLastname('Theother');
        $user15->setPassword($this->encoder->encodePassword($user15, 'user15'));
        $user15->setEmail('user15@example.com');
        $user15->setIsActive(true);
        $user15 = $this->setRoles($user15, array('role-user'));
        $user15->setOrganization($this->getReference('org-28'));
        $user15->setOccupation(OccupationChoiceLoader::OCCUPATION_THEOTHER_ID);
        $user15->setGender(GenderChoiceLoader::GENDER_NS_ID);
        $user15->setType(AccountChoiceLoader::ACCOUNT_PARTICIPANT_ID);
        $manager->persist($user15);
        
        /*-- Account type --*/
        // Operation staff && teacher
        $user16 = new User();
        $user16->setTitle(TitleChoiceLoader::TITLE_DR_ID);
        $user16->setFirstname('Account');
        $user16->setLastname('Operationandteacher');
        $user16->setPassword($this->encoder->encodePassword($user16, 'user21'));
        $user16->setEmail('user21@example.com');
        $user16->setIsActive(true);
        $user16 = $this->setRoles($user16, array('role-user'));
        $user16->setOrganization($this->getReference('org-8'));
        $user16->setOccupation(OccupationChoiceLoader::OCCUPATION_TEACHER_ID);
        $user16->setGender(GenderChoiceLoader::GENDER_MALE_ID);
        $user16->setType(AccountChoiceLoader::ACCOUNT_STAFF_ID);
        $manager->persist($user16);
        
        // Operation staff && the other
        $user17 = new User();
        $user17->setTitle(TitleChoiceLoader::TITLE_DR_ID);
        $user17->setFirstname('Account');
        $user17->setLastname('Opperationtheother');
        $user17->setPassword($this->encoder->encodePassword($user17, 'user22'));
        $user17->setEmail('user22@example.com');
        $user17->setIsActive(true);
        $user17 = $this->setRoles($user17, array('role-user'));
        $user17->setOrganization($this->getReference('org-8'));
        $user17->setOccupation(OccupationChoiceLoader::OCCUPATION_THEOTHER_ID);
        $user17->setGender(GenderChoiceLoader::GENDER_FEMALE_ID);
        $user17->setType(AccountChoiceLoader::ACCOUNT_STAFF_ID);
        $manager->persist($user17);
        
        // Observer
        $user18 = new User();
        $user18->setTitle(TitleChoiceLoader::TITLE_DR_ID);
        $user18->setFirstname('John');
        $user18->setLastname('Simons');
        $user18->setPassword($this->encoder->encodePassword($user18, 'user23'));
        $user18->setEmail('user23@example.com');
        $user18->setIsActive(true);
        $user18 = $this->setRoles($user18, array('role-user'));
        $user18->setOrganization($this->getReference('org-8'));
        $user18->setOccupation(OccupationChoiceLoader::OCCUPATION_TEACHER_ID);
        $user18->setGender(GenderChoiceLoader::GENDER_NS_ID);
        $user18->setType(AccountChoiceLoader::ACCOUNT_OBSERVER_ID);
        $manager->persist($user18);
        
        /*-- Activate --*/
        // Inactive
        $user19 = new User();
        $user19->setTitle(TitleChoiceLoader::TITLE_DR_ID);
        $user19->setFirstname('Active');
        $user19->setLastname('Inactive');
        $user19->setPassword($this->encoder->encodePassword($user19, 'user31'));
        $user19->setEmail('user31@example.com');
        $user19->setIsActive(false);
        $user19 = $this->setRoles($user19, array('role-user'));
        $user19->setOrganization($this->getReference('org-8'));
        $user19->setOccupation(OccupationChoiceLoader::OCCUPATION_STUDENT_ID);
        $user19->setGender(GenderChoiceLoader::GENDER_MALE_ID);
        $user19->setType(AccountChoiceLoader::ACCOUNT_PARTICIPANT_ID);
        $manager->persist($user19);
        
        $manager->flush();
        
        $this->addReference('user-super-admin', $user1);
        $this->addReference('user-admin',       $user2);
        $this->addReference('user-power-user',  $user3);
        $this->addReference('user-user',        $user4);
        
        $this->addReference('user-student',     $user5);
        $this->addReference('user-teacher',     $user6);
        $this->addReference('user-deputy',      $user7);
        $this->addReference('user-director',    $user8);
        $this->addReference('user-jocv',        $user9);
        $this->addReference('user-theother',    $user10);
    }
    
    protected function setRoles(User $user, array $roles)
    {
        foreach ($roles as $roles) {
            $role = $this->getReference($roles);
            $user->addRole($role);
        }
        return $user;
    }
        
    public function getOrder()
    {
        return 10;
    }
}
