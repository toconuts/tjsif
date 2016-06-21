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
    const OCCUPATION_DEPUTY         = 'Deputy / Vice Principal';
    const OCCUPATION_DIRECTOR       = 'Director / Principal';
    const OCCUPATION_JOCV           = 'JOCV';
    const OCCUPATION_THEOTHER       = 'The other';
    
    const OCCUPATION_STUDENT_ID     =  '1';
    const OCCUPATION_TEACHER_ID     =  '2';
    const OCCUPATION_DEPUTY_ID      =  '4';
    const OCCUPATION_DIRECTOR_ID    =  '8';
    const OCCUPATION_JOCV_ID        = '16';
    const OCCUPATION_THEOTHER_ID    = '32';
    
    protected $choices =
    [
        'Student'                   =>  '1', //0b00000001
        'Teacher'                   =>  '2', //0b00000010
        'Deputy / Vice Principal'   =>  '4', //0b00000100
        'Director / Principal'      =>  '8', //0b00001000
        'JOCV'                      => '16', //0b00010000
        'The other'                 => '32', //0b00100000
    ];
}
