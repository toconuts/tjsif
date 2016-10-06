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

use Symfony\Component\Security\Core\Validator\Constraints as SecurityAssert;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Description of ChangePassword
 *
 * @author toconuts toconuts@gmail.com
 */
class ChangePassword
{
    /**
     * @SecurityAssert\UserPassword(
     *     message = "Wrong value for your current password"
     * )
     */
    protected $oldPassword;
     
    /**
     * @Assert\Length(
     *     min = 6,
     *     minMessage = "Password should by at least 6 chars long"
     * )
     * @Assert\NotBlank()
     */
    protected $newPassword;
    
    /**
     * Set password
     *
     * @param string $password
     *
     * @return ChangePassword
     */
    public function setOldPassword($password)
    {
        $this->oldPassword = $password;

        return $this;
    }

    /**
     * get old password
     * 
     * @return string
     */
    public function getOldPassword()
    {
        return $this->oldPassword;
    }
    
    /**
     * Set password
     *
     * @param string $password
     *
     * @return ChangePassword
     */
    public function setNewPassword($password)
    {
        $this->newPassword = $password;

        return $this;
    }

    /**
     * get old password
     * 
     * @return string
     */
    public function getNewPassword()
    {
        return $this->newPassword;
    }
    
}
