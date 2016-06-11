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
        'All'                   => '0',
        'Student'               => '1',
        'Teacher'               => '2',
        'Principals'            => '3',
        'JOCV'                  => '5',
        'The other'             => '6',
        'Student & Teacher'     => '12',
        'Teacher & Principal'   => '13',
    ];
    
    public function getChoices()
    {
        return $choices;
    }
}