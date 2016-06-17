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
 * Description of DocumentType
 *
 * @author toconuts <toconuts@gmail.com>
 */
class DocumentType extends AbstractChoiceLoader
{
    protected $choices =
    [
        'Abstract (.docx)'      => '1',
        'Abstract (.pdf)'       => '2',
        'Full paper(.docx)'     => '3',
        'Full Paper(.pdf)'     => '4',
    ];
    
    
}
