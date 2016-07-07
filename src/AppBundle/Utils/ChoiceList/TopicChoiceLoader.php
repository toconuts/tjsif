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
    const TOPIC_APPLICATION     = 'Application / Software';
    const TOPIC_ROBOTICS        = 'Robotics / Hardware';
    const TOPIC_IOT             = 'Internet of Thing (IoT)';
    
    const TOPIC_APPLICATION_ID  = '1';
    const TOPIC_ROBOTICS_ID     = '2';
    const TOPIC_IOT_ID          = '3';
    
    protected $choices = array(
        self::TOPIC_APPLICATION => self::TOPIC_APPLICATION_ID,
        self::TOPIC_ROBOTICS    => self::TOPIC_ROBOTICS_ID,
        self::TOPIC_IOT         => self::TOPIC_IOT_ID,
    );
}
