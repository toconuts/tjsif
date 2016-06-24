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
 * Description of DocumentChoiceLoader
 *
 * @author toconuts <toconuts@gmail.com>
 */
class DocumentChoiceLoader extends AbstractChoiceLoader
{
    const DOCUMENT_ABSTRACT_DOCX    = 'Abstract (.docx)';
    const DOCUMENT_ABSTRACT_PDF     = 'Abstract (.pdf)';
    const DOCUMENT_FULLPAPER_DOCX   = 'Full paper(.docx)';
    const DOCUMENT_FULLPAPER_PDF    = 'Full Paper(.pdf)';
    
    const DOCUMENT_ABSTRACT_DOCX_ID    = '1';
    const DOCUMENT_ABSTRACT_PDF_ID     = '2';
    const DOCUMENT_FULLPAPER_DOCX_ID   = '3';
    const DOCUMENT_FULLPAPER_PDF_ID    = '4';
    
    protected $choices = array(
        self::DOCUMENT_ABSTRACT_DOCX    => self::DOCUMENT_ABSTRACT_DOCX_ID,
        self::DOCUMENT_ABSTRACT_PDF     => self::DOCUMENT_ABSTRACT_PDF_ID,
        self::DOCUMENT_FULLPAPER_DOCX   => self::DOCUMENT_FULLPAPER_DOCX_ID,
        self::DOCUMENT_FULLPAPER_PDF    => self::DOCUMENT_FULLPAPER_PDF_ID,
    );
    
    /*protected $choices =
    [
        'Abstract (.docx)'  => '1',
        'Abstract (.pdf)'   => '2',
        'Full paper(.docx)' => '3',
        'Full Paper(.pdf)'  => '4',
    ];*/
}
