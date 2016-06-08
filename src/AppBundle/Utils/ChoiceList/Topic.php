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
class Topic extends AbstractChoiceLoader
{
    protected $choices =
    [
        'Software'                  => '1',
        'Hardware'                  => '2',
        'Application'               => '3',
        'Internet of Thing (IoT)'   => '4',
        'Robotics'                  => '5',
    ];
}
