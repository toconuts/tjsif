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
 * Description of OrganizationForm
 *
 * @author toconuts <toconuts@gmail.com>
 */
class OrganizationForm extends AbstractChoiceLoader
{
    protected $choices =
    [
        'School'        => '1',
        'Government'    => '2',
        'Company'       => '3',
        'The other'     => '4',
    ];
}
