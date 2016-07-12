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

        /**
         * THAI PCSHS
         */
        $org_1_01 = new Organization();
        $org_1_01->setName('Princess Churabhorn Science High School Chiang Rai');
        $org_1_01->setShortname('PCSHS Chiang Rai');
        $org_1_01->setCity('Chiang Rai');
        $org_1_01->setProvince('Chiang Rai');
        $org_1_01->setCountry(self::TH);
        $org_1_01->setType(OrganizationChoiceLoader::ORGANIZATION_FORM_12_PCSHS_ID);
        $org_1_01 = $this->setSysters($org_1_01, array());
        $manager->persist($org_1_01);
        $this->addReference('org-1-01', $org_1_01);
        
        $org_1_02 = new Organization();
        $org_1_02->setName('Princess Churabhorn Science High School Phitsanulok');
        $org_1_02->setShortname('PCSHS Phitsanulok');
        $org_1_02->setCity('Phitsanulok');
        $org_1_02->setProvince('Phitsanulok');
        $org_1_02->setCountry(self::TH);
        $org_1_02->setType(OrganizationChoiceLoader::ORGANIZATION_FORM_12_PCSHS_ID);
        $org_1_02 = $this->setSysters($org_1_02, array());
        $manager->persist($org_1_02);
        $this->addReference('org-1-02', $org_1_02);
        
        $org_1_03 = new Organization();
        $org_1_03->setName('Princess Churabhorn Science High School Lopburi');
        $org_1_03->setShortname('PCSHS Lopburi');
        $org_1_03->setCity('Lopburi');
        $org_1_03->setProvince('Lopburi');
        $org_1_03->setCountry(self::TH);
        $org_1_03->setType(OrganizationChoiceLoader::ORGANIZATION_FORM_12_PCSHS_ID);
        $org_1_03 = $this->setSysters($org_1_03, array());
        $manager->persist($org_1_03);
        $this->addReference('org-1-03', $org_1_03);
        
        $org_1_04 = new Organization();
        $org_1_04->setName('Princess Churabhorn Science High School Loei');
        $org_1_04->setShortname('PCSHS Loei');
        $org_1_04->setCity('Loei');
        $org_1_04->setProvince('Loei');
        $org_1_04->setCountry(self::TH);
        $org_1_04->setType(OrganizationChoiceLoader::ORGANIZATION_FORM_12_PCSHS_ID);
        $org_1_04 = $this->setSysters($org_1_04, array());
        $manager->persist($org_1_04);
        $this->addReference('org-1-04', $org_1_04);
        
        $org_1_05 = new Organization();
        $org_1_05->setName('Princess Churabhorn Science High School Burirum');
        $org_1_05->setShortname('PCSHS Burirum');
        $org_1_05->setCity('Burirum');
        $org_1_05->setProvince('Burirum');
        $org_1_05->setCountry(self::TH);
        $org_1_05->setType(OrganizationChoiceLoader::ORGANIZATION_FORM_12_PCSHS_ID);
        $org_1_05 = $this->setSysters($org_1_05, array());
        $manager->persist($org_1_05);
        $this->addReference('org-1-05', $org_1_05);
        
        $org_1_06 = new Organization();
        $org_1_06->setName('Princess Churabhorn Science High School Mukdahan');
        $org_1_06->setShortname('PCSHS Mukdahan');
        $org_1_06->setCity('Mukdahan');
        $org_1_06->setProvince('Mukdahan');
        $org_1_06->setCountry(self::TH);
        $org_1_06->setType(OrganizationChoiceLoader::ORGANIZATION_FORM_12_PCSHS_ID);
        $org_1_06 = $this->setSysters($org_1_06, array());
        $manager->persist($org_1_06);
        $this->addReference('org-1-06', $org_1_06);
        
        $org_1_07 = new Organization();
        $org_1_07->setName('Princess Churabhorn Science High School Phathum thani');
        $org_1_07->setShortname('PCSHS Phathum thani');
        $org_1_07->setCity('Phathum thani');
        $org_1_07->setProvince('Phathum thani');
        $org_1_07->setCountry(self::TH);
        $org_1_07->setType(OrganizationChoiceLoader::ORGANIZATION_FORM_12_PCSHS_ID);
        $org_1_07 = $this->setSysters($org_1_07, array());
        $manager->persist($org_1_07);
        $this->addReference('org-1-07', $org_1_07);
        
        $org_1_08 = new Organization();
        $org_1_08->setName('Princess Churabhorn Science High School Chonburi');
        $org_1_08->setShortname('PCSHS Chonburi');
        $org_1_08->setCity('Chonburi');
        $org_1_08->setProvince('Chonburi');
        $org_1_08->setCountry(self::TH);
        $org_1_08->setType(OrganizationChoiceLoader::ORGANIZATION_FORM_12_PCSHS_ID);
        $org_1_08 = $this->setSysters($org_1_08, array());
        $manager->persist($org_1_08);
        $this->addReference('org-1-08', $org_1_08);
        
        $org_1_09 = new Organization();
        $org_1_09->setName('Princess Churabhorn Science High School Phetchaburi');
        $org_1_09->setShortname('PCSHS Phetchaburi');
        $org_1_09->setCity('Phetchaburi');
        $org_1_09->setProvince('Phetchaburi');
        $org_1_09->setCountry(self::TH);
        $org_1_09->setType(OrganizationChoiceLoader::ORGANIZATION_FORM_12_PCSHS_ID);
        $org_1_09 = $this->setSysters($org_1_09, array());
        $manager->persist($org_1_09);
        $this->addReference('org-1-09', $org_1_09);
        
        $org_1_10 = new Organization();
        $org_1_10->setName('Princess Churabhorn Science High School Nakhon Si Thammarat');
        $org_1_10->setShortname('PCSHS Nakhon Si Thammarat');
        $org_1_10->setCity('Nakhon Si Thammarat');
        $org_1_10->setProvince('Nakhon Si Thammarat');
        $org_1_10->setCountry(self::TH);
        $org_1_10->setType(OrganizationChoiceLoader::ORGANIZATION_FORM_12_PCSHS_ID);
        $org_1_10 = $this->setSysters($org_1_10, array());
        $manager->persist($org_1_10);
        $this->addReference('org-1-10', $org_1_10);
        
        $org_1_11 = new Organization();
        $org_1_11->setName('Princess Churabhorn Science High School Trang');
        $org_1_11->setShortname('PCSHS Trang');
        $org_1_11->setCity('Trang');
        $org_1_11->setProvince('Trang');
        $org_1_11->setCountry(self::TH);
        $org_1_11->setType(OrganizationChoiceLoader::ORGANIZATION_FORM_12_PCSHS_ID);
        $org_1_11 = $this->setSysters($org_1_11, array());
        $manager->persist($org_1_11);
        $this->addReference('org-1-11', $org_1_11);
        
        $org_1_12 = new Organization();
        $org_1_12->setName('Princess Churabhorn Science High School Satun');
        $org_1_12->setShortname('PCSHS Satun');
        $org_1_12->setCity('Satun');
        $org_1_12->setProvince('Satun');
        $org_1_12->setCountry(self::TH);
        $org_1_12->setType(OrganizationChoiceLoader::ORGANIZATION_FORM_12_PCSHS_ID);
        $org_1_12 = $this->setSysters($org_1_12, array());
        $manager->persist($org_1_12);
        $this->addReference('org-1-12', $org_1_12);
        
        /**
         * Japan SSHS
         */
        $org_2_01 = new Organization();
        $org_2_01->setName('Tokyo Gakugei University Senior High School');
        $org_2_01->setShortname('Tokyo Gakugei');
        $org_2_01->setCity('Gakugei');
        $org_2_01->setProvince('Tokyo');
        $org_2_01->setCountry(self::JP);
        $org_2_01->setType(OrganizationChoiceLoader::ORGANIZATION_FORM_SSHS_JAPAN_ID);
        $org_2_01 = $this->setSysters($org_2_01, array('org-1-01'));
        $manager->persist($org_2_01);
        $this->addReference('org-2-01', $org_2_01);
        
        $org_2_02 = new Organization();
        $org_2_02->setName('Hokkaido Sapporo Kaisei SHS');
        $org_2_02->setShortname('Hokkaido Kaisei');
        $org_2_02->setCity('Sapporo');
        $org_2_02->setProvince('Hokkaido');
        $org_2_02->setCountry(self::JP);
        $org_2_02->setType(OrganizationChoiceLoader::ORGANIZATION_FORM_SSHS_JAPAN_ID);
        $org_2_02 = $this->setSysters($org_2_02, array('org-1-02'));
        $manager->persist($org_2_02);
        $this->addReference('org-2-02', $org_2_02);
        
        $org_2_03 = new Organization();
        $org_2_03->setName('Oita Maizuru High School');
        $org_2_03->setShortname('Oita Maizuru');
        $org_2_03->setCity('Maizuru');
        $org_2_03->setProvince('Oita');
        $org_2_03->setCountry(self::JP);
        $org_2_03->setType(OrganizationChoiceLoader::ORGANIZATION_FORM_SSHS_JAPAN_ID);
        $org_2_03 = $this->setSysters($org_2_03, array('org-1-03'));
        $manager->persist($org_2_03);
        $this->addReference('org-2-03', $org_2_03);
        
        $org_2_04 = new Organization();
        $org_2_04->setName('Fukuoka Jyoto High School of Fukuoka Institute of Technology');
        $org_2_04->setShortname('Fukuoka Jyoto');
        $org_2_04->setCity('Jyoto');
        $org_2_04->setProvince('Fukuoka');
        $org_2_04->setCountry(self::JP);
        $org_2_04->setType(OrganizationChoiceLoader::ORGANIZATION_FORM_SSHS_JAPAN_ID);
        $org_2_04 = $this->setSysters($org_2_04, array('org-1-04'));
        $manager->persist($org_2_04);
        $this->addReference('org-2-04', $org_2_04);
        
        $org_2_05 = new Organization();
        $org_2_05->setName('Tokyo Tech High School of Science and Technology');
        $org_2_05->setShortname('Tokyo Tech');
        $org_2_05->setCity('Tokyo');
        $org_2_05->setProvince('Tokyo');
        $org_2_05->setCountry(self::JP);
        $org_2_05->setType(OrganizationChoiceLoader::ORGANIZATION_FORM_SSHS_JAPAN_ID);
        $org_2_05 = $this->setSysters($org_2_05, array('org-1-05'));
        $manager->persist($org_2_05);
        $this->addReference('org-2-05', $org_2_05);
        
        $org_2_06 = new Organization();
        $org_2_06->setName('Hiroshima University Attached High School');
        $org_2_06->setShortname('Hiroshima University');
        $org_2_06->setCity('Hiroshima');
        $org_2_06->setProvince('LopHiroshimaburi');
        $org_2_06->setCountry(self::JP);
        $org_2_06->setType(OrganizationChoiceLoader::ORGANIZATION_FORM_SSHS_JAPAN_ID);
        $org_2_06 = $this->setSysters($org_2_06, array('org-1-06'));
        $manager->persist($org_2_06);
        $this->addReference('org-2-06', $org_2_06);
        
        $org_2_07 = new Organization();
        $org_2_07->setName('Tennoji High School attached to Osaka Kyoiko University');
        $org_2_07->setShortname('Osaka Kyoiko Tennoji');
        $org_2_07->setCity('Tennoji');
        $org_2_07->setProvince('Osaka');
        $org_2_07->setCountry(self::JP);
        $org_2_07->setType(OrganizationChoiceLoader::ORGANIZATION_FORM_SSHS_JAPAN_ID);
        $org_2_07 = $this->setSysters($org_2_07, array('org-1-07'));
        $manager->persist($org_2_07);
        $this->addReference('org-2-07', $org_2_07);
        
        $org_2_08 = new Organization();
        $org_2_08->setName('Ichikawa Gakuen Ichikawa Junior & Senior High School');
        $org_2_08->setShortname('Ichikawa Gakuen');
        $org_2_08->setCity('Ichikawa');
        $org_2_08->setProvince('Chiba');
        $org_2_08->setCountry(self::JP);
        $org_2_08->setType(OrganizationChoiceLoader::ORGANIZATION_FORM_SSHS_JAPAN_ID);
        $org_2_08 = $this->setSysters($org_2_08, array('org-1-08'));
        $manager->persist($org_2_08);
        $this->addReference('org-2-08', $org_2_08);
        
        $org_2_09 = new Organization();
        $org_2_09->setName('Bunkyo Gakuin University Girls\' Senior High School');
        $org_2_09->setShortname('Bunkyo Gakuin');
        $org_2_09->setCity('Tokyo');
        $org_2_09->setProvince('Tokyo');
        $org_2_09->setCountry(self::JP);
        $org_2_09->setType(OrganizationChoiceLoader::ORGANIZATION_FORM_SSHS_JAPAN_ID);
        $org_2_09 = $this->setSysters($org_2_09, array('org-1-09'));
        $manager->persist($org_2_09);
        $this->addReference('org-2-09', $org_2_09);
        
        $org_2_10 = new Organization();
        $org_2_10->setName('Nara Prefectural Seisho High School');
        $org_2_10->setShortname('Nara Seisho');
        $org_2_10->setCity('Nara');
        $org_2_10->setProvince('Nara');
        $org_2_10->setCountry(self::JP);
        $org_2_10->setType(OrganizationChoiceLoader::ORGANIZATION_FORM_SSHS_JAPAN_ID);
        $org_2_10 = $this->setSysters($org_2_10, array('org-1-10'));
        $manager->persist($org_2_10);
        $this->addReference('org-2-10', $org_2_10);
        
        $org_2_11 = new Organization();
        $org_2_11->setName('Meijo University Senior High School');
        $org_2_11->setShortname('Meijo University');
        $org_2_11->setCity('Nagoya');
        $org_2_11->setProvince('Aichi');
        $org_2_11->setCountry(self::JP);
        $org_2_11->setType(OrganizationChoiceLoader::ORGANIZATION_FORM_SSHS_JAPAN_ID);
        $org_2_11 = $this->setSysters($org_2_11, array('org-1-11'));
        $manager->persist($org_2_11);
        $this->addReference('org-2-11', $org_2_11);
        
        $org_2_12 = new Organization();
        $org_2_12->setName('Furukawa Reimei Junior & Senior High School');
        $org_2_12->setShortname('Furukawa Reimei');
        $org_2_12->setCity('Osaki');
        $org_2_12->setProvince('Miyagi');
        $org_2_12->setCountry(self::JP);
        $org_2_12->setType(OrganizationChoiceLoader::ORGANIZATION_FORM_SSHS_JAPAN_ID);
        $org_2_12 = $this->setSysters($org_2_12, array('org-1-12'));
        $manager->persist($org_2_12);
        $this->addReference('org-2-12', $org_2_12);
        
        /**
         * Syster school in thai
         */
        $org_3_01 = new Organization();
        $org_3_01->setName('Banbueng High School');
        $org_3_01->setShortname('Banbueng High School');
        $org_3_01->setCity('Banbueng');
        $org_3_01->setProvince('Chonburi');
        $org_3_01->setCountry(self::TH);
        $org_3_01->setType(OrganizationChoiceLoader::ORGANIZATION_FORM_SISTER_THAI_ID);
        $org_3_01 = $this->setSysters($org_3_01, array('org-1-08'));
        $manager->persist($org_3_01);
        $this->addReference('org-3-01', $org_3_01);
        
        /**
         * University
         */
        $org_4_01 = new Organization();
        $org_4_01->setName('King Mongkut\'s Institute of Technology Ladkrabang');
        $org_4_01->setShortname('KMITL');
        $org_4_01->setCity('Lat Krabang');
        $org_4_01->setProvince('Bangkok');
        $org_4_01->setCountry(self::TH);
        $org_4_01->setType(OrganizationChoiceLoader::ORGANIZATION_FORM_SSHS_JAPAN_ID);
        $org_4_01 = $this->setSysters($org_4_01, array());
        $manager->persist($org_4_01);
        $this->addReference('org-4-01', $org_4_01);
        
        /**
         * Government
         */
        $org_5_01 = new Organization();
        $org_5_01->setName('Japan International Cooperation Agency Thailand Office');
        $org_5_01->setShortname('JICA Thai');
        $org_5_01->setCity('Klongtoey');
        $org_5_01->setProvince('Bangkok');
        $org_5_01->setCountry(self::TH);
        $org_5_01->setType(OrganizationChoiceLoader::ORGANIZATION_FORM_GOVERNMENT_ID);
        $org_5_01 = $this->setSysters($org_5_01, array());
        $manager->persist($org_5_01);
        $this->addReference('org-5-01', $org_5_01);
        
        /**
         * Company
         */
        $org_6_01 = new Organization();
        $org_6_01->setName('SAKURA INTERNET CO., LTD.');
        $org_6_01->setShortname('Sakura');
        $org_6_01->setCity('Amata Nakorn');
        $org_6_01->setProvince('Chonburi');
        $org_6_01->setCountry(self::TH);
        $org_6_01->setType(OrganizationChoiceLoader::ORGANIZATION_FORM_COMPANY_ID);
        $org_6_01 = $this->setSysters($org_6_01, array());
        $manager->persist($org_6_01);
        $this->addReference('org-6-01', $org_6_01);
        
        /**
         * The other
         */
        $org_99_01 = new Organization();
        $org_99_01->setName('The Asia Foundation');
        $org_99_01->setShortname('The Asia Foundation');
        $org_99_01->setCity('Klongtoey');
        $org_99_01->setProvince('Bangkok');
        $org_99_01->setCountry(self::TH);
        $org_99_01->setType(OrganizationChoiceLoader::ORGANIZATION_FORM_THEOTHER_ID);
        $org_99_01 = $this->setSysters($org_99_01, array());
        $manager->persist($org_99_01);
        $this->addReference('org-99-01', $org_99_01);
        
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
