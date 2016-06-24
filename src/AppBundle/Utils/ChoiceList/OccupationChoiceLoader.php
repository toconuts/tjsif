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
 * Description of OccupationChoiceLoader
 *
 * @author toconuts <toconuts@gmail.com>
 */
class OccupationChoiceLoader extends AbstractChoiceLoader
{
    const OCCUPATION_STUDENT        = 'Student';
    const OCCUPATION_TEACHER        = 'Teacher';
    const OCCUPATION_DEPUTY         = 'Deputy';
    const OCCUPATION_DIRECTOR       = 'Director';
    const OCCUPATION_JOCV           = 'JOCV';
    const OCCUPATION_THEOTHER       = 'The other';
    
    const OCCUPATION_STUDENT_ID     =  '1';
    const OCCUPATION_TEACHER_ID     =  '2';
    const OCCUPATION_DEPUTY_ID      =  '4';
    const OCCUPATION_DIRECTOR_ID    =  '8';
    const OCCUPATION_JOCV_ID        = '16';
    const OCCUPATION_THEOTHER_ID    = '32';
    
    protected $choices = array(
        self::OCCUPATION_STUDENT    => self::OCCUPATION_STUDENT_ID,
        self::OCCUPATION_TEACHER    => self::OCCUPATION_TEACHER_ID,
        self::OCCUPATION_DEPUTY     => self::OCCUPATION_DEPUTY_ID,
        self::OCCUPATION_DIRECTOR   => self::OCCUPATION_DIRECTOR_ID,
        self::OCCUPATION_JOCV       => self::OCCUPATION_JOCV_ID,
        self::OCCUPATION_THEOTHER   => self::OCCUPATION_THEOTHER_ID,
    );
}
