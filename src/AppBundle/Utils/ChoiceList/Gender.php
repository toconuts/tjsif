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
 * Description of Gender
 *
 * @author toconuts <toconuts@gmail.com>
 */
class Gender extends AbstractChoiceLoader
{
    protected $choices =
    [
        'Not specified' => 0,
        'Male'          => 1,
        'Female'        => 2,
    ];
}
