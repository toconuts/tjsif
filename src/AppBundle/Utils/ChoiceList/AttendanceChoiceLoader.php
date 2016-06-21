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
 * Description of AttendanceChoiceLoader
 *
 * @author toconuts <toconuts@gmail.com>
 */
class AttendanceChoiceLoader extends AbstractChoiceLoader
{
    const ATTENDANCE_YES    = 'Yes';
    const ATTENDANCE_NO     = 'No';
    const ATTENDANCE_MAYBE  = 'Maybe';
    
    const ATTENDANCE_YES_VALUE    = true;
    const ATTENDANCE_NO_VALUE     = false;
    const ATTENDANCE_MAYBE_VALUE  = null;
    
    protected $choices =
    [
        'Yes' => true,
        'No' => false,
        'Maybe' => null,
    ];
}
