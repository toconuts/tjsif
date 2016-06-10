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
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Description of Program
 *
 * @author toconuts <toconuts@gmail.com>
 * 
 * @ORM\Table(name="activity")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Activity
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\Column(type="string", length=250)
     */
    private $name;
    
    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $venue;
    
    /**
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;
    
    /**
     * @ORM\Column(type="string", length=10)
     */
    private $target;
    
    /**
     * @ORM\Column(name="is_confirm", type="boolean")
     */
    private $isConfirm;
    
    /**
     * @ORM\Column(name="is_official", type="boolean")
     */
    private $isOfficial;
    
    /**
     * @ORM\OneToMany(targetEntity="Attendance", mappedBy="activity")
     */
    private $attendances;
    
    /**
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;

    /**
     * Set id
     *
     * @param integer $id
     *
     * @return Program
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
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
     * Set name
     *
     * @param string $name
     *
     * @return Program
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set venue
     *
     * @param string $venue
     *
     * @return Program
     */
    public function setVenue($venue)
    {
        $this->venue = $venue;

        return $this;
    }

    /**
     * Get venue
     *
     * @return string
     */
    public function getVenue()
    {
        return $this->venue;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Program
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Program
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
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
     * Constructor
     */
    public function __construct()
    {
        $this->attendances = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add attendance
     *
     * @param \AppBundle\Entity\Attendance $attendance
     *
     * @return Program
     */
    public function addAttendance(\AppBundle\Entity\Attendance $attendance)
    {
        $this->attendances[] = $attendance;

        return $this;
    }

    /**
     * Remove attendance
     *
     * @param \AppBundle\Entity\Attendance $attendance
     */
    public function removeAttendance(\AppBundle\Entity\Attendance $attendance)
    {
        $this->attendances->removeElement($attendance);
    }

    /**
     * Get attendances
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAttendances()
    {
        return $this->attendances;
    }

    /**
     * Set target
     *
     * @param string $target
     *
     * @return Activity
     */
    public function setTarget($target)
    {
        $this->target = $target;

        return $this;
    }

    /**
     * Get target
     *
     * @return string
     */
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * Set isConfirm
     *
     * @param boolean $isConfirm
     *
     * @return Activity
     */
    public function setIsConfirm($isConfirm)
    {
        $this->isConfirm = $isConfirm;

        return $this;
    }

    /**
     * Get isConfirm
     *
     * @return boolean
     */
    public function getIsConfirm()
    {
        return $this->isConfirm;
    }

    /**
     * Set isOfficial
     *
     * @param boolean $isOfficial
     *
     * @return Activity
     */
    public function setIsOfficial($isOfficial)
    {
        $this->isOfficial = $isOfficial;

        return $this;
    }

    /**
     * Get isOfficial
     *
     * @return boolean
     */
    public function getIsOfficial()
    {
        return $this->isOfficial;
    }
}
