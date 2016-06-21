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
    const ORGANIZATION_FORM_HIGH_SCHOOL = 'High School';
    const ORGANIZATION_FORM_UNIVERSITY  = 'University';
    const ORGANIZATION_FORM_GOVERNMENT  = 'Government';
    const ORGANIZATION_FORM_COMPANY     = 'Company';
    const ORGANIZATION_FORM_THEOTHER    = 'The other';
    
    const ORGANIZATION_FORM_HIGH_SCHOOL_ID  = '1';
    const ORGANIZATION_FORM_UNIVERSITY_ID   = '2';
    const ORGANIZATION_FORM_GOVERNMENT_ID   = '3';
    const ORGANIZATION_FORM_COMPANY_ID      = '4';
    const ORGANIZATION_FORM_THEOTHER_ID     = '5';

    protected $choices =
    [
        'High School'   => '1',
        'University'    => '2',
        'Government'    => '3',
        'Company'       => '4',
        'The other'     => '5',
    ];
}
