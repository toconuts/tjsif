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

use Symfony\Component\Form\ChoiceList\ArrayChoiceList;
use Symfony\Component\Form\ChoiceList\Loader\ChoiceLoaderInterface;

/**
 * Description of AbstractChoiceLoader
 *
 * @author toconuts <toconuts@gmail.com>
 */
abstract class AbstractChoiceLoader implements ChoiceLoaderInterface
{
    protected $choices;

    public function loadChoiceList($value = null)
    {
        return new ArrayChoiceList($this->choices);
    }

    public function loadChoicesForValues(array $values, $value = null)
    {
        $result = [ ];

        foreach ($values as $val)
        {
            $key = array_search($val, $this->choices, true);

            if ($key !== false)
                $result[ ] = $val;
        }

        return $result;
    }

    public function loadValuesForChoices(array $choices, $value = null)
    {
        $result = [ ];

        foreach ($choices as $choice)
        {
            $key = array_search($choice, $this->choices, true);

            if ($key !== false)
                $result[ ] = $choice;
        }

        return $result;
    }
    
    public function getChoices()
    {
        return $this->choices;
    }
    
    public function getChoicesFliped()
    {
        $choices_fliped = array_flip($this->choices);
        return $choices_fliped;
    }
}
