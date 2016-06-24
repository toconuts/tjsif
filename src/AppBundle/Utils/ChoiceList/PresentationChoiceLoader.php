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
 * Description of PresentationChoiceLoader
 *
 * @author toconuts <toconuts@gmail.com>
 */
class PresentationChoiceLoader extends AbstractChoiceLoader
{
    const PRESENTATION_ORAL     = 'Oral';
    const PRESENTATION_POSTER   = 'Poster';
    
    const PRESENTATION_ORAL_ID      = '1';
    const PRESENTATION_POSTER_ID    = '2';
    
    protected $choices = array(
        self::PRESENTATION_ORAL     => self::PRESENTATION_ORAL_ID,
        self::PRESENTATION_POSTER   => self::PRESENTATION_POSTER_ID,
    );
    
    /*
    protected $choices =
    [
        'Oral'          => '1',
        'Poster'        => '2',
    ];*/
}
