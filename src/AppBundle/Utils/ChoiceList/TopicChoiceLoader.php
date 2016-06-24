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
 * Description of TopicChoiceLoader
 *
 * @author toconuts <toconuts@gmail.com>
 */
class TopicChoiceLoader extends AbstractChoiceLoader
{
    const TITLE_APPLICATION     = 'Application / Software';
    const TITLE_ROBOTICS        = 'Robotics / Hardware';
    const TITLE_IOT             = 'Internet of Thing (IoT)';
    
    const TITLE_APPLICATION_ID  = '1';
    const TITLE_ROBOTICS_ID     = '2';
    const TITLE_IOT_ID          = '3';
    
    protected $choices = array(
        self::TITLE_APPLICATION => self::TITLE_APPLICATION_ID,
        self::TITLE_ROBOTICS    => self::TITLE_ROBOTICS_ID,
        self::TITLE_IOT         => self::TITLE_IOT_ID,
    );

    /*protected $choices =
    [
        'Application / Software'    => '1',
        'Robotics / Hardware'       => '2',
        'Internet of Thing (IoT)'   => '3',
    ];*/
}
