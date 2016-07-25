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
 * Description of CategoryChoiceLoader
 *
 * @author toconuts <toconuts@gmail.com>
 */
class CategoryChoiceLoader extends AbstractChoiceLoader
{
    const CATEGORY_AGRICULTURE              = 'Agriculture';
    const CATEGORY_HEALTHCARE               = 'Healthcare';
    const CATEGORY_EDUCATION                = 'Education';
    const CATEGORY_SERVICES                 = 'Services';
    const CATEGORY_ENTERTAINMENT_AND_GAMES  = 'Entertainment and Games';
    const CATEGORY_HOUSEHOLD_ACTIVITIES     = 'Household';
    const CATEGORY_GENERAL_ACTIVITIES       = 'General Activities';
    
    const CATEGORY_AGRICULTURE_ID              = '1';
    const CATEGORY_HEALTHCARE_ID               = '2';
    const CATEGORY_EDUCATION_ID                = '3';
    const CATEGORY_SERVICES_ID                 = '4';
    const CATEGORY_ENTERTAINMENT_AND_GAMES_ID  = '5';
    const CATEGORY_HOUSEHOLD_ACTIVITIES_ID     = '6';
    const CATEGORY_GENERAL_ACTIVITIES_ID       = '7';
    
    protected $choices = array(
        self::CATEGORY_AGRICULTURE              => self::CATEGORY_AGRICULTURE_ID,
        self::CATEGORY_HEALTHCARE               => self::CATEGORY_HEALTHCARE_ID,
        self::CATEGORY_EDUCATION                => self::CATEGORY_EDUCATION_ID,
        self::CATEGORY_SERVICES                 => self::CATEGORY_SERVICES_ID,
        self::CATEGORY_ENTERTAINMENT_AND_GAMES  => self::CATEGORY_ENTERTAINMENT_AND_GAMES_ID,
        self::CATEGORY_HOUSEHOLD_ACTIVITIES     => self::CATEGORY_HOUSEHOLD_ACTIVITIES_ID,
        self::CATEGORY_GENERAL_ACTIVITIES       => self::CATEGORY_GENERAL_ACTIVITIES_ID,
    );
}
