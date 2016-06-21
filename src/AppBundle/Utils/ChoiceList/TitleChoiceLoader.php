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
 * Description of TitleChoiceLoader
 *
 * @author toconuts <toconuts@gmail.com>
 */
class TitleChoiceLoader extends AbstractChoiceLoader
{
    const TITLE_MR      = 'Mr.';
    const TITLE_MS      = 'Ms.';
    const TITLE_MRS     = 'Mrs.';
    const TITLE_MISS    = 'Miss.';
    const TITLE_DR      = 'Dr.';
    
    const TITLE_MR_ID   = '1';
    const TITLE_MS_ID   = '2';
    const TITLE_MRS_ID  = '3';
    const TITLE_MISS_ID = '4';
    const TITLE_DR_ID   = '5';
    
    protected $choices =
    [
        'Mr.'   => '1',
        'Ms.'   => '2',
        'Mrs.'  => '3',
        'Miss.' => '4',
        'Dr.'   => '5',
    ];
}
