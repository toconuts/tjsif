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
 * Description of TargetChoiceLoader
 *
 * @author toconuts <toconuts@gmail.com>
 */
class TargetChoiceLoader extends AbstractChoiceLoader
{
    const TARGET_ALL                        = 'All';
    const TARGET_STUDENT                    = 'Student';
    const TARGET_TEACHER                    = 'Teacher';
    const TARGET_PRINCIPALS                 = 'Principals';
    const TARGET_JOCV                       = 'JOCV';
    const TARGET_THEOTHER                   = 'The other';
    const TARGET_STUDENT_AND_TEACHER        = 'Student & Teacher';
    const TARGET_TEACHER_AND_PRINCIPALS     = 'Teacher & Principals';
    
    const TARGET_ALL_ID                     = '63';
    const TARGET_STUDENT_ID                 =  '1';
    const TARGET_TEACHER_ID                 =  '2';
    const TARGET_PRINCIPALS_ID              = '16';
    const TARGET_JOCV_ID                    = '32';
    const TARGET_THEOTHER_ID                = '32';
    const TARGET_STUDENT_AND_TEACHER_ID     =  '3';
    const TARGET_TEACHER_AND_PRINCIPALS_ID  = '14';
    
    protected $choices =
    [
        'All'                   => '63', //0b00111111
        'Student'               =>  '1', //0b00000001
        'Teacher'               =>  '2', //0b00000010
        'Principals'            => '12', //0b00001100
        'JOCV'                  => '16', //0b00010000
        'The other'             => '32', //0b00100000
        'Student & Teacher'     =>  '3', //0b00000011
        'Teacher & Principals'  => '14', //0b00001110
    ];
}
