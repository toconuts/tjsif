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
 * Description of GenderChoiceLoader
 *
 * @author toconuts <toconuts@gmail.com>
 */
class GenderChoiceLoader extends AbstractChoiceLoader
{
    const GENDER_NS     = 'Not specified';
    const GENDER_MALE   = 'Male';
    const GENDER_FEMALE = 'Female';
    
    const GENDER_NS_ID      = null;
    const GENDER_MALE_ID    = '1';
    const GENDER_FEMALE_ID  = '2';
    
    protected $choices = array(
        self::GENDER_NS     => self::GENDER_NS_ID,
        self::GENDER_MALE   => self::GENDER_MALE_ID,
        self::GENDER_FEMALE => self::GENDER_FEMALE_ID,
    );
    
    /*
    protected $choices =
    [
        'Not specified' => null,
        'Male'          => '1',
        'Female'        => '2',
    ];*/
    
    
    
}
