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

use AppBundle\Utils\ChoiceList\OrganizationChoiceLoader;

/**
 * Description of LoadOrganizationData
 *
 * @author toconuts <toconuts@gmail.com>
 */
class LoadOrganizationData extends AbstractFixture implements OrderedFixtureInterface
{
    /* Country */
    const TH = 'TH';
    const JP = 'JP';
   
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        //$orgForms = (new OrganizationChoiceLoader())->getChoices();

        /*--- THAI PCSHS ---*/
        $org1 = new Organization();
        $org1->setName('Princess Churabhorn Science High School Chiang Rai');
        $org1->setShortname('PCSHS Chiang Rai');
        $org1->setCity('Chiang Rai');
        $org1->setProvince('Chiang Rai');
        $org1->setCountry(self::TH);
        $org1->setType(OrganizationChoiceLoader::ORGANIZATION_FORM_HIGH_SCHOOL_ID);
        $org1 = $this->setSysters($org1, array());
        $manager->persist($org1);
        $this->addReference('org-1', $org1);
        
        $org2 = new Organization();
        $org2->setName('Princess Churabhorn Science High School Phitsanulok');
        $org2->setShortname('PCSHS Phitsanulok');
        $org2->setCity('Phitsanulok');
        $org2->setProvince('Phitsanulok');
        $org2->setCountry(self::TH);
        $org2->setType(OrganizationChoiceLoader::ORGANIZATION_FORM_HIGH_SCHOOL_ID);
        $org2 = $this->setSysters($org2, array());
        $manager->persist($org2);
        $this->addReference('org-2', $org2);
        
        $org3 = new Organization();
        $org3->setName('Princess Churabhorn Science High School Lopburi');
        $org3->setShortname('PCSHS Lopburi');
        $org3->setCity('Lopburi');
        $org3->setProvince('Lopburi');
        $org3->setCountry(self::TH);
        $org3->setType(OrganizationChoiceLoader::ORGANIZATION_FORM_HIGH_SCHOOL_ID);
        $org3 = $this->setSysters($org3, array());
        $manager->persist($org3);
        $this->addReference('org-3', $org3);
        
        $org4 = new Organization();
        $org4->setName('Princess Churabhorn Science High School Loei');
        $org4->setShortname('PCSHS Loei');
        $org4->setCity('Loei');
        $org4->setProvince('Loei');
        $org4->setCountry(self::TH);
        $org4->setType(OrganizationChoiceLoader::ORGANIZATION_FORM_HIGH_SCHOOL_ID);
        $org4 = $this->setSysters($org4, array());
        $manager->persist($org4);
        $this->addReference('org-4', $org4);
        
        $org5 = new Organization();
        $org5->setName('Princess Churabhorn Science High School Burirum');
        $org5->setShortname('PCSHS Burirum');
        $org5->setCity('Burirum');
        $org5->setProvince('Burirum');
        $org5->setCountry(self::TH);
        $org5->setType(OrganizationChoiceLoader::ORGANIZATION_FORM_HIGH_SCHOOL_ID);
        $org5 = $this->setSysters($org5, array());
        $manager->persist($org5);
        $this->addReference('org-5', $org5);
        
        $org6 = new Organization();
        $org6->setName('Princess Churabhorn Science High School Mukdahan');
        $org6->setShortname('PCSHS Mukdahan');
        $org6->setCity('Mukdahan');
        $org6->setProvince('Mukdahan');
        $org6->setCountry(self::TH);
        $org6->setType(OrganizationChoiceLoader::ORGANIZATION_FORM_HIGH_SCHOOL_ID);
        $org6 = $this->setSysters($org6, array());
        $manager->persist($org6);
        $this->addReference('org-6', $org6);
        
        $org7 = new Organization();
        $org7->setName('Princess Churabhorn Science High School Phathum thani');
        $org7->setShortname('PCSHS Phathum thani');
        $org7->setCity('Phathum thani');
        $org7->setProvince('Phathum thani');
        $org7->setCountry(self::TH);
        $org7->setType(OrganizationChoiceLoader::ORGANIZATION_FORM_HIGH_SCHOOL_ID);
        $org7 = $this->setSysters($org7, array());
        $manager->persist($org7);
        $this->addReference('org-7', $org7);
        
        $org8 = new Organization();
        $org8->setName('Princess Churabhorn Science High School Chonburi');
        $org8->setShortname('PCSHS Chonburi');
        $org8->setCity('Chonburi');
        $org8->setProvince('Chonburi');
        $org8->setCountry(self::TH);
        $org8->setType(OrganizationChoiceLoader::ORGANIZATION_FORM_HIGH_SCHOOL_ID);
        $org8 = $this->setSysters($org8, array());
        $manager->persist($org8);
        $this->addReference('org-8', $org8);
        
        $org9 = new Organization();
        $org9->setName('Princess Churabhorn Science High School Phetchaburi');
        $org9->setShortname('PCSHS Phetchaburi');
        $org9->setCity('Phetchaburi');
        $org9->setProvince('Phetchaburi');
        $org9->setCountry(self::TH);
        $org9->setType(OrganizationChoiceLoader::ORGANIZATION_FORM_HIGH_SCHOOL_ID);
        $org9 = $this->setSysters($org9, array());
        $manager->persist($org9);
        $this->addReference('org-9', $org9);
        
        $org10 = new Organization();
        $org10->setName('Princess Churabhorn Science High School Nakhon Si Thammarat');
        $org10->setShortname('PCSHS Nakhon Si Thammarat');
        $org10->setCity('Nakhon Si Thammarat');
        $org10->setProvince('Nakhon Si Thammarat');
        $org10->setCountry(self::TH);
        $org10->setType(OrganizationChoiceLoader::ORGANIZATION_FORM_HIGH_SCHOOL_ID);
        $org10 = $this->setSysters($org10, array());
        $manager->persist($org10);
        $this->addReference('org-10', $org10);
        
        $org11 = new Organization();
        $org11->setName('Princess Churabhorn Science High School Trang');
        $org11->setShortname('PCSHS Trang');
        $org11->setCity('Trang');
        $org11->setProvince('Trang');
        $org11->setCountry(self::TH);
        $org11->setType(OrganizationChoiceLoader::ORGANIZATION_FORM_HIGH_SCHOOL_ID);
        $org11 = $this->setSysters($org11, array());
        $manager->persist($org11);
        $this->addReference('org-11', $org11);
        
        $org12 = new Organization();
        $org12->setName('Princess Churabhorn Science High School Satun');
        $org12->setShortname('PCSHS Satun');
        $org12->setCity('Satun');
        $org12->setProvince('Satun');
        $org12->setCountry(self::TH);
        $org12->setType(OrganizationChoiceLoader::ORGANIZATION_FORM_HIGH_SCHOOL_ID);
        $org12 = $this->setSysters($org12, array());
        $manager->persist($org12);
        $this->addReference('org-12', $org12);
        
        /*--- Japan SSHS ---*/
        $org13 = new Organization();
        $org13->setName('Tokyo Gakugei University Senior High School');
        $org13->setShortname('Tokyo Gakugei');
        $org13->setCity('Gakugei');
        $org13->setProvince('Tokyo');
        $org13->setCountry(self::JP);
        $org13->setType(OrganizationChoiceLoader::ORGANIZATION_FORM_HIGH_SCHOOL_ID);
        $org13 = $this->setSysters($org13, array('org-1'));
        $manager->persist($org13);
        $this->addReference('org-13', $org13);
        
        $org14 = new Organization();
        $org14->setName('Hokkaido Sapporo Kaisei SHS');
        $org14->setShortname('Hokkaido Kaisei');
        $org14->setCity('Sapporo');
        $org14->setProvince('Hokkaido');
        $org14->setCountry(self::JP);
        $org14->setType(OrganizationChoiceLoader::ORGANIZATION_FORM_HIGH_SCHOOL_ID);
        $org14 = $this->setSysters($org14, array('org-2'));
        $manager->persist($org14);
        $this->addReference('org-14', $org14);
        
        $org15 = new Organization();
        $org15->setName('Oita Maizuru High School');
        $org15->setShortname('Oita Maizuru');
        $org15->setCity('Maizuru');
        $org15->setProvince('Oita');
        $org15->setCountry(self::JP);
        $org15->setType(OrganizationChoiceLoader::ORGANIZATION_FORM_HIGH_SCHOOL_ID);
        $org15 = $this->setSysters($org15, array('org-3'));
        $manager->persist($org15);
        $this->addReference('org-15', $org15);
        
        $org16 = new Organization();
        $org16->setName('Fukuoka Jyoto High School of Fukuoka Institute of Technology');
        $org16->setShortname('Fukuoka Jyoto');
        $org16->setCity('Jyoto');
        $org16->setProvince('Fukuoka');
        $org16->setCountry(self::JP);
        $org16->setType(OrganizationChoiceLoader::ORGANIZATION_FORM_HIGH_SCHOOL_ID);
        $org16 = $this->setSysters($org16, array('org-4'));
        $manager->persist($org16);
        $this->addReference('org-16', $org16);
        
        $org17 = new Organization();
        $org17->setName('Tokyo Tech High School of Science and Technology');
        $org17->setShortname('Tokyo Tech');
        $org17->setCity('Tokyo');
        $org17->setProvince('Tokyo');
        $org17->setCountry(self::JP);
        $org17->setType(OrganizationChoiceLoader::ORGANIZATION_FORM_HIGH_SCHOOL_ID);
        $org17 = $this->setSysters($org17, array('org-5'));
        $manager->persist($org17);
        $this->addReference('org-17', $org17);
        
        $org18 = new Organization();
        $org18->setName('Hiroshima University Attached High School');
        $org18->setShortname('Hiroshima University');
        $org18->setCity('Hiroshima');
        $org18->setProvince('LopHiroshimaburi');
        $org18->setCountry(self::JP);
        $org18->setType(OrganizationChoiceLoader::ORGANIZATION_FORM_HIGH_SCHOOL_ID);
        $org18 = $this->setSysters($org18, array('org-6'));
        $manager->persist($org18);
        $this->addReference('org-18', $org18);
        
        $org19 = new Organization();
        $org19->setName('Tennoji High School attached to Osaka Kyoiko University');
        $org19->setShortname('Osaka Kyoiko Tennoji');
        $org19->setCity('Tennoji');
        $org19->setProvince('Osaka');
        $org19->setCountry(self::JP);
        $org19->setType(OrganizationChoiceLoader::ORGANIZATION_FORM_HIGH_SCHOOL_ID);
        $org19 = $this->setSysters($org19, array('org-7'));
        $manager->persist($org19);
        $this->addReference('org-19', $org19);
        
        $org20 = new Organization();
        $org20->setName('Ichikawa Gakuen Ichikawa Junior & Senior High School');
        $org20->setShortname('Ichikawa Gakuen');
        $org20->setCity('Ichikawa');
        $org20->setProvince('Chiba');
        $org20->setCountry(self::JP);
        $org20->setType(OrganizationChoiceLoader::ORGANIZATION_FORM_HIGH_SCHOOL_ID);
        $org20 = $this->setSysters($org20, array('org-8'));
        $manager->persist($org20);
        $this->addReference('org-20', $org20);
        
        $org21 = new Organization();
        $org21->setName('Bunkyo Gakuin University Girls\' Senior High School');
        $org21->setShortname('Bunkyo Gakuin');
        $org21->setCity('Tokyo');
        $org21->setProvince('Tokyo');
        $org21->setCountry(self::JP);
        $org21->setType(OrganizationChoiceLoader::ORGANIZATION_FORM_HIGH_SCHOOL_ID);
        $org21 = $this->setSysters($org21, array('org-9'));
        $manager->persist($org21);
        $this->addReference('org-21', $org21);
        
        $org22 = new Organization();
        $org22->setName('Nara Prefectural Seisho High School');
        $org22->setShortname('Nara Seisho');
        $org22->setCity('Nara');
        $org22->setProvince('Nara');
        $org22->setCountry(self::JP);
        $org22->setType(OrganizationChoiceLoader::ORGANIZATION_FORM_HIGH_SCHOOL_ID);
        $org22 = $this->setSysters($org22, array('org-10'));
        $manager->persist($org22);
        $this->addReference('org-22', $org22);
        
        $org23 = new Organization();
        $org23->setName('Meijo University Senior High School');
        $org23->setShortname('Meijo University');
        $org23->setCity('Nagoya');
        $org23->setProvince('Aichi');
        $org23->setCountry(self::JP);
        $org23->setType(OrganizationChoiceLoader::ORGANIZATION_FORM_HIGH_SCHOOL_ID);
        $org23 = $this->setSysters($org23, array('org-11'));
        $manager->persist($org23);
        $this->addReference('org-23', $org23);
        
        $org24 = new Organization();
        $org24->setName('Furukawa Reimei Junior & Senior High School');
        $org24->setShortname('Furukawa Reimei');
        $org24->setCity('Osaki');
        $org24->setProvince('Miyagi');
        $org24->setCountry(self::JP);
        $org24->setType(OrganizationChoiceLoader::ORGANIZATION_FORM_HIGH_SCHOOL_ID);
        $org24 = $this->setSysters($org24, array('org-12'));
        $manager->persist($org24);
        $this->addReference('org-24', $org24);
        
        /*--- University ---*/
        $org25 = new Organization();
        $org25->setName('King Mongkut\'s Institute of Technology Ladkrabang');
        $org25->setShortname('KMITL');
        $org25->setCity('Lat Krabang');
        $org25->setProvince('Bangkok');
        $org25->setCountry(self::TH);
        $org25->setType(OrganizationChoiceLoader::ORGANIZATION_FORM_UNIVERSITY_ID);
        $org25 = $this->setSysters($org25, array());
        $manager->persist($org25);
        $this->addReference('org-25', $org25);
        
        /*--- Government ---*/
        $org26 = new Organization();
        $org26->setName('Japan International Cooperation Agency Thailand Office');
        $org26->setShortname('JICA Thai');
        $org26->setCity('Klongtoey');
        $org26->setProvince('Bangkok');
        $org26->setCountry(self::TH);
        $org26->setType(OrganizationChoiceLoader::ORGANIZATION_FORM_GOVERNMENT_ID);
        $org26 = $this->setSysters($org26, array());
        $manager->persist($org26);
        $this->addReference('org-26', $org26);
        
        /*--- Company ---*/
        $org27 = new Organization();
        $org27->setName('SAKURA INTERNET CO., LTD.');
        $org27->setShortname('Sakura');
        $org27->setCity('Amata Nakorn');
        $org27->setProvince('Chonburi');
        $org27->setCountry(self::TH);
        $org27->setType(OrganizationChoiceLoader::ORGANIZATION_FORM_COMPANY_ID);
        $org27 = $this->setSysters($org27, array());
        $manager->persist($org27);
        $this->addReference('org-27', $org27);
        
        /*--- The other ---*/
        $org28 = new Organization();
        $org28->setName('The Asia Foundation');
        $org28->setShortname('The Asia Foundation');
        $org28->setCity('Klongtoey');
        $org28->setProvince('Bangkok');
        $org28->setCountry(self::TH);
        $org28->setType(OrganizationChoiceLoader::ORGANIZATION_FORM_THEOTHER_ID);
        $org28 = $this->setSysters($org28, array());
        $manager->persist($org28);
        $this->addReference('org-28', $org28);
        
        $manager->flush();
        
    }
    
    protected function setSysters(Organization $organization, $sisters)
    {
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
