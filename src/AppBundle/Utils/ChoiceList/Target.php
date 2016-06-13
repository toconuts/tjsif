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
 * Description of Target
 *
 * @author toconuts <toconuts@gmail.com>
 */
class Target extends AbstractChoiceLoader
{
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
