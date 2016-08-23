<?php

/*
 * This file is part of the TJ-SIF 2016 project.
 *
 * (c) toconuts <toconuts@google.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use AppBundle\Entity\User;

/**
 * Description of ResettingPassword
 *
 * @author toconuts <toconuts@gmail.com>
 * 
 * @ORM\Table(name="resetting_password")
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity(fields="user", message="User already taken")
 */
class ResettingPassword
{
    const TOKEN_TTL = 86400;
    
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * Random string sent to the user email address in order to verify it
     *
     * @ORM\Column(name="confirmation_token", type="string", length=100, nullable=true)
     */
    protected $confirmationToken;
    
    /**
     * @ORM\Column(name="verification_code", type="string", length=20, nullable=true)
     */
    private $verificationCode;
    
    /**
     * @Assert\NotBlank()
     * @var string 
     */
    private $userVerificationCode;
    
    /**
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    private $updatedAt;
    
    /**
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 6,
     *      max = 4096,
     *      minMessage = "Password should by at least 6 chars long")
     */
    private $newPassword;
    
    public function __construct($user = null)
    {
        $this->user = $user;
    }
    
    /**
     * @Assert\Callback
     * 
     * @param ExecutionContextInterface $context
     */
    public function validate(ExecutionContextInterface $context)
    {
        if (!$this->verificationCode) {
            return;
        }
        
        if ($this->verificationCode !== $this->userVerificationCode) {
            $context
                ->buildViolation('Invalid verification code. Please check the email.')
                ->atPath('userVerificationCode')
                ->addViolation()
            ;
        }
    }
    
    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set confirmationToken
     *
     * @param string $confirmationToken
     *
     * @return ResettingPassword
     */
    public function setConfirmationToken($confirmationToken)
    {
        $this->confirmationToken = $confirmationToken;

        return $this;
    }

    /**
     * Get confirmationToken
     *
     * @return string
     */
    public function getConfirmationToken()
    {
        return $this->confirmationToken;
    }

    /**
     * Set verificationCode
     *
     * @param string $verificationCode
     *
     * @return ResettingPassword
     */
    public function setVerificationCode($verificationCode)
    {
        $this->verificationCode = $verificationCode;

        return $this;
    }

    /**
     * Get verificationCode
     *
     * @return string
     */
    public function getVerificationCode()
    {
        return $this->verificationCode;
    }

    /**
     * Set userVerificationCode
     *
     * @param string $verificationCode
     *
     * @return userVerificationCode
     */
    public function setUserVerificationCode($verificationCode)
    {
        $this->userVerificationCode = $verificationCode;

        return $this;
    }

    /**
     * Get userVerificationCode
     *
     * @return string
     */
    public function getUserVerificationCode()
    {
        return $this->userVerificationCode;
    }
    
    /**
     * Set createdAt
     *
     * @ORM\PrePersist
     */
    public function setCreatedAt()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @ORM\PreUpdate
     */
    public function setUpdatedAt()
    {
        $this->updatedAt = new \DateTime();
    }

    /**
     * Get updatedAt
     * 
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
    

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return ResettingPassword
     */
    public function setUser(User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
    
    /**
     * Set new password
     * 
     * @param string $password
     * @return string
     */
    public function setNewPassword($password)
    {
        $this->newPassword = $password;
        
        return $this->newPassword;
    }
    
    /**
     * Get new password
     * 
     * @return string
     */
    public function getNewPassword()
    {
        return $this->newPassword;
    }
    
    /**
     * Whether the request for resetting password is expired or not.
     * 
     * @return boolean
     */
    public function isPasswordRequestNonExpired()
    {
        if (null === $this->confirmationToken || null === $this->verificationCode) {
            return false;
        }
        
        return $this->getUpdatedAt() instanceof \DateTime &&
               $this->getUpdatedAt()->getTimestamp() + self::TOKEN_TTL > time();
    }
}
