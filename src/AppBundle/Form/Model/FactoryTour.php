<?php

/*
 * This file is part of the TJ-SIF 2016 project.
 *
 * (c) toconuts <toconuts@google.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Form\Model;

use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Utils\ChoiceList\FactoryTourChoiceLoader;

/**
 * Description of FactoryTour
 *
 * @author toconuts toconuts@gmail.com
 */
class FactoryTour
{
    static $CAPACITIES = array(
        FactoryTourChoiceLoader::FACTORY_TOUR_TOYOTA_ID =>  83,
        FactoryTourChoiceLoader::FACTORY_TOUR_HINO_ID   =>  40,
        FactoryTourChoiceLoader::FACTORY_TOUR_MCP_ID    =>  40,
        FactoryTourChoiceLoader::FACTORY_TOUR_KUBOTA_ID =>  40,
    );
    
    private $numbersOfRegisters;


    /**
     * @Assert\NotBlank()
     */
    protected $company;
    
    /**
     * Set company
     *
     * @param string $company
     *
     * @return string
     */
    public function setCompany($company)
    {
        $this->company = $company;
        $this->numbersOfRegisters = array();
        
        return $this;
    }

    /**
     * Get compnay
     * 
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }

    public function __construct()
    {
        $this->company = FactoryTourChoiceLoader::FACTORY_TOUR_TOYOTA_ID;
    }
    
    public function getNumbersOfRegisters()
    {
        return $this->numbersOfRegisters;
    }

    public function addNumbersOfRegisters($key, $value)
    {
        $this->numbersOfRegisters[$key] = $value;
        
        return $this->numbersOfRegisters;
    }
    
    public function resetNumberOfRegisters()
    {
        $this->numbersOfRegisters = array();
    }
    
    public function getCapacities()
    {
        return self::$CAPACITIES;
    }
}
