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
 * Description of AccountChoiceLoader
 *
 * @author toconuts <toconuts@gmail.com>
 */
class AccountChoiceLoader extends AbstractChoiceLoader
{
    const ACCOUNT_PARTICIPANT  = 'Participant';
    const ACCOUNT_STAFF        = 'Operation staff';
    const ACCOUNT_OBSERVER     = 'Observer';

    const ACCOUNT_PARTICIPANT_ID  = '1';
    const ACCOUNT_STAFF_ID        = '2';
    const ACCOUNT_OBSERVER_ID     = '3';
    
    protected $choices =
    [
        'Participant'       => '1',
        'Operation staff'   => '2',
        'Observer'          => '3',
    ];
}
