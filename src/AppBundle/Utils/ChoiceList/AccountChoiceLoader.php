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
    const ACCOUNT_PARTICIPANT           = 'Participant';
    const ACCOUNT_CONTACT_PERSON        = 'Contact person';
    const ACCOUNT_CONTACT_PERSON_NA     = 'Contact person (Not attendee)';
    const ACCOUNT_STAFF                 = 'Operation staff';
    const ACCOUNT_OBSERVER              = 'Observer';

    const ACCOUNT_PARTICIPANT_ID        = '1';
    const ACCOUNT_CONTACT_PERSON_ID     = '2';
    const ACCOUNT_STAFF_ID              = '3';
    const ACCOUNT_OBSERVER_ID           = '4';
    const ACCOUNT_CONTACT_PERSON_NA_ID  = '5';
    
    
    protected $choices = array(
        self::ACCOUNT_PARTICIPANT    => self::ACCOUNT_PARTICIPANT_ID,
        self::ACCOUNT_CONTACT_PERSON => self::ACCOUNT_CONTACT_PERSON_ID,
        self::ACCOUNT_CONTACT_PERSON_NA => self::ACCOUNT_CONTACT_PERSON_NA_ID,
        self::ACCOUNT_STAFF          => self::ACCOUNT_STAFF_ID,
        self::ACCOUNT_OBSERVER       => self::ACCOUNT_OBSERVER_ID,
    );
}
