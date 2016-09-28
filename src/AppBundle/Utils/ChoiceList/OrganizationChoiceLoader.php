<?php

/*
 * This file is part of the TJ-SIF 2016 project.
 *
 * (c) toconuts <toconuts@google.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Utils\ChoiceList;

use AppBundle\Utils\ChoiceList\AbstractChoiceLoader;

/**
 * Description of OrganizationChoiceLoader
 *
 * @author toconuts <toconuts@gmail.com>
 */
class OrganizationChoiceLoader extends AbstractChoiceLoader
{
    const ORGANIZATION_FORM_12_PCSHS    = '12 PCSH School';
    const ORGANIZATION_FORM_SSHS_JAPAN  = 'SSH School in Japan';
    const ORGANIZATION_FORM_SISTER_THAI = 'Sister School in Thai';
    const ORGANIZATION_FORM_SHS_THAI    = 'SH School in Thai';
    const ORGANIZATION_FORM_UNIVERSITY  = 'University';
    const ORGANIZATION_FORM_GOVERNMENT  = 'Government';
    const ORGANIZATION_FORM_COMPANY     = 'Company';
    const ORGANIZATION_FORM_THEOTHER    = 'The other';
    
    const ORGANIZATION_FORM_12_PCSHS_ID     = '1';
    const ORGANIZATION_FORM_SSHS_JAPAN_ID   = '2';
    const ORGANIZATION_FORM_SISTER_THAI_ID  = '3';
    const ORGANIZATION_FORM_SHS_THAI_ID     = '4';
    const ORGANIZATION_FORM_UNIVERSITY_ID   = '10';
    const ORGANIZATION_FORM_GOVERNMENT_ID   = '20';
    const ORGANIZATION_FORM_COMPANY_ID      = '30';
    const ORGANIZATION_FORM_THEOTHER_ID     = '99';

    protected $choices = array(
        self::ORGANIZATION_FORM_12_PCSHS    => self::ORGANIZATION_FORM_12_PCSHS_ID,
        self::ORGANIZATION_FORM_SSHS_JAPAN  => self::ORGANIZATION_FORM_SSHS_JAPAN_ID,
        self::ORGANIZATION_FORM_SISTER_THAI => self::ORGANIZATION_FORM_SISTER_THAI_ID,
        self::ORGANIZATION_FORM_SHS_THAI    => self::ORGANIZATION_FORM_SHS_THAI_ID,
        self::ORGANIZATION_FORM_UNIVERSITY  => self::ORGANIZATION_FORM_UNIVERSITY_ID,
        self::ORGANIZATION_FORM_GOVERNMENT  => self::ORGANIZATION_FORM_GOVERNMENT_ID,
        self::ORGANIZATION_FORM_COMPANY     => self::ORGANIZATION_FORM_COMPANY_ID,
        self::ORGANIZATION_FORM_THEOTHER    => self::ORGANIZATION_FORM_THEOTHER_ID,
    );

}
