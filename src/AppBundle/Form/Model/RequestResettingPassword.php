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

/**
 * Description of class RequestRessetingPassword
 *
 * @author toconuts toconuts@gmail.com
 */
class RequestResettingPassword
{
    /**
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;
    
    /**
     * Set email
     * 
     * @param string $email
     * @return string
     */
    public function setEmail($email)
    {
        $this->email = $email;
        
        return $this->email;
    }
    
    /**
     * Get email
     * 
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
    
}
