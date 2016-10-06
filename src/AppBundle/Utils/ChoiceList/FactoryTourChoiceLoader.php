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
 * Description of FactoryTourChoiceLoader
 *
 * @author toconuts <toconuts@gmail.com>
 */
class FactoryTourChoiceLoader extends AbstractChoiceLoader
{
    const FACTORY_TOUR_TOYOTA       = 'Factory Tour (TOYOTA)';
    const FACTORY_TOUR_HINO         = 'Factory Tour (HINO)';
    const FACTORY_TOUR_MCP          = 'Factory Tour (MCP)';
    const FACTORY_TOUR_KUBOTA       = 'Factory Tour (KUBOTA)';
    
    const FACTORY_TOUR_TOYOTA_ID    =    '1';
    const FACTORY_TOUR_HINO_ID      =    '2';
    const FACTORY_TOUR_MCP_ID       =    '3';
    const FACTORY_TOUR_KUBOTA_ID    =    '4';

    protected $choices = array(
        self::FACTORY_TOUR_TOYOTA   => self::FACTORY_TOUR_TOYOTA_ID,
        self::FACTORY_TOUR_HINO     => self::FACTORY_TOUR_HINO_ID,
        self::FACTORY_TOUR_MCP      => self::FACTORY_TOUR_MCP_ID,
        self::FACTORY_TOUR_KUBOTA   => self::FACTORY_TOUR_KUBOTA_ID,
    );
}
