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
use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Utils\ChoiceList\AccountType;

/**
 * Organization
 *
 * @author toconuts <toconuts@gmail.com>
 * 
 * @ORM\Table(name="organization")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\OrganizationRepository")
 * @UniqueEntity(fields="id", message="id already taken")
 */
class Organization
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=25)
     * @Assert\NotBlank() 
     */
    private $shortname;
    
    /**
     * @ORM\OneToMany(targetEntity="User", mappedBy="organization")
     */
    private $users;
    
    /**
     * @ORM\OneToMany(targetEntity="Project", mappedBy="organization")
     */
    private $projects;
    
    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $address1;
    
    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $address2;
    
    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $city;
    
    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $province;
    
    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Assert\NotNull()
     * @Assert\Country()
     */
    private $country;
    
    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     * @Assert\Regex(pattern="/^\d+(-\d+)*$/")
     */
    private $zip;
    
    /**
     * @ORM\Column(type="string", length=60, nullable=true)
     * @Assert\Regex(pattern="/^\d+(-\d+)*$/")
     */
    private $tel;
    
    /**
     * @ORM\Column(type="string", length=60, nullable=true)
     * @Assert\Regex(pattern="/^\d+(-\d+)*$/")
     */
    private $fax;
    
    /**
     * @ORM\Column(type="string", length=60, nullable=true)
     * @Assert\Email()
     */
    private $email;   
    
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Url
     */
    private $homepage;
    
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Url
     */
    private $blog;
    
    /**
     * @ORM\Column(type="string", length=10)
     * @Assert\NotNull()
     */
    private $type;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;
    
    /**
     * @ORM\ManyToMany(targetEntity="Organization", mappedBy="sisters")
     */
    private $sistersWithMe;

    /**
     * @ORM\ManyToMany(targetEntity="Organization", inversedBy="sistersWithMe")
     * @ORM\JoinTable(name="sisters",
     *      joinColumns={@ORM\JoinColumn(name="organization_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="sister_organization_id", referencedColumnName="id")}
     *      )
     */
    private $sisters;
    
    /**
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var User $createdBy
     *
     * @Gedmo\Blameable(on="create")
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(name="created_by", referencedColumnName="id")
     */
    private $createdBy;

    /**
     * @var User $updatedBy
     *
     * @Gedmo\Blameable(on="update")
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(name="updated_by",referencedColumnName="id")
     */
    private $updatedBy;
    
    /**
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    private $updatedAt;
    
    /**
     * @ORM\OneToOne(targetEntity="OrganizationPicture", mappedBy="organization")
     */
    private $picture;
    
    /**
     * @ORM\Column(type="integer")
     */
    private $counter;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->projects = new ArrayCollection();
        $this->sisters = new ArrayCollection();
        $this->sistersWithMe = new ArrayCollection();
        $this->isActive = true;
        $this->counter = 0;
    }

    /**
     * Get id
     *
     * @return int
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
     * @return School
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
     * Add user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return School
     */
    public function addUser(\AppBundle\Entity\User $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \AppBundle\Entity\User $user
     */
    public function removeUser(\AppBundle\Entity\User $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
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
     * Set tel
     *
     * @param string $tel
     *
     * @return Organization
     */
    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * Get tel
     *
     * @return string
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Set fax
     *
     * @param string $fax
     *
     * @return Organization
     */
    public function setFax($fax)
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * Get fax
     *
     * @return string
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Organization
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
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

    /**
     * Set homepage
     *
     * @param string $homepage
     *
     * @return Organization
     */
    public function setHomepage($homepage)
    {
        $this->homepage = $homepage;

        return $this;
    }

    /**
     * Get homepage
     *
     * @return string
     */
    public function getHomepage()
    {
        return $this->homepage;
    }

    /**
     * Set blog
     *
     * @param string $blog
     *
     * @return Organization
     */
    public function setBlog($blog)
    {
        $this->blog = $blog;

        return $this;
    }

    /**
     * Get blog
     *
     * @return string
     */
    public function getBlog()
    {
        return $this->blog;
    }

    /**
     * Add project
     *
     * @param \AppBundle\Entity\Project $project
     *
     * @return Organization
     */
    public function addProject(\AppBundle\Entity\Project $project)
    {
        $this->projects[] = $project;

        return $this;
    }

    /**
     * Remove project
     *
     * @param \AppBundle\Entity\Project $project
     */
    public function removeProject(\AppBundle\Entity\Project $project)
    {
        $this->projects->removeElement($project);
    }

    /**
     * Get projects
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProjects()
    {
        return $this->projects;
    }
    
    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return User
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }
    
    /**
     * Set address1
     *
     * @param string $address1
     *
     * @return Organization
     */
    public function setAddress1($address1)
    {
        $this->address1 = $address1;

        return $this;
    }

    /**
     * Get address1
     *
     * @return string
     */
    public function getAddress1()
    {
        return $this->address1;
    }

    /**
     * Set address2
     *
     * @param string $address2
     *
     * @return Organization
     */
    public function setAddress2($address2)
    {
        $this->address2 = $address2;

        return $this;
    }

    /**
     * Get address2
     *
     * @return string
     */
    public function getAddress2()
    {
        return $this->address2;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return Organization
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set province
     *
     * @param string $province
     *
     * @return Organization
     */
    public function setProvince($province)
    {
        $this->province = $province;

        return $this;
    }

    /**
     * Get province
     *
     * @return string
     */
    public function getProvince()
    {
        return $this->province;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return Organization
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set zip
     *
     * @param string $zip
     *
     * @return Organization
     */
    public function setZip($zip)
    {
        $this->zip = $zip;

        return $this;
    }

    /**
     * Get zip
     *
     * @return string
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * Set shortname
     *
     * @param string $shortname
     *
     * @return Organization
     */
    public function setShortname($shortname)
    {
        $this->shortname = $shortname;

        return $this;
    }

    /**
     * Get shortname
     *
     * @return string
     */
    public function getShortname()
    {
        return $this->shortname;
    }


    /**
     * Add sistersWithMe
     *
     * @param \AppBundle\Entity\Organization $sistersWithMe
     *
     * @return Organization
     */
    public function addSistersWithMe(\AppBundle\Entity\Organization $sistersWithMe)
    {
        $this->sistersWithMe[] = $sistersWithMe;

        return $this;
    }

    /**
     * Remove sistersWithMe
     *
     * @param \AppBundle\Entity\Organization $sistersWithMe
     */
    public function removeSistersWithMe(\AppBundle\Entity\Organization $sistersWithMe)
    {
        $this->sistersWithMe->removeElement($sistersWithMe);
    }

    /**
     * Get sistersWithMe
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSistersWithMe()
    {
        return $this->sistersWithMe;
    }

    /**
     * Add sister
     *
     * @param \AppBundle\Entity\Organization $sister
     *
     * @return Organization
     */
    public function addSister(\AppBundle\Entity\Organization $sister)
    {
        $this->sisters[] = $sister;

        return $this;
    }

    /**
     * Remove sister
     *
     * @param \AppBundle\Entity\Organization $sister
     */
    public function removeSister(\AppBundle\Entity\Organization $sister)
    {
        $this->sisters->removeElement($sister);
    }

    /**
     * Get sisters
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSisters()
    {
        return $this->sisters;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Organization
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
    
    /**
     * Get createdBy
     * 
     * @return User
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Get updatedBy
     * 
     * @return User
     */
    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }

    /**
     * Set createdBy
     *
     * @param \AppBundle\Entity\User $createdBy
     *
     * @return Organization
     */
    public function setCreatedBy(\AppBundle\Entity\User $createdBy = null)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * Set updatedBy
     *
     * @param \AppBundle\Entity\User $updatedBy
     *
     * @return Organization
     */
    public function setUpdatedBy(\AppBundle\Entity\User $updatedBy = null)
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }

    /**
     * Set picture
     *
     * @param \AppBundle\Entity\OrganizationPicture $picture
     *
     * @return Organization
     */
    public function setPicture(\AppBundle\Entity\OrganizationPicture $picture = null)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture
     *
     * @return \AppBundle\Entity\OrganizationPicture
     */
    public function getPicture()
    {
        return $this->picture;
    }
    
    /**
     * Set counter
     *
     * @param integer $counter
     *
     * @return Project
     */
    public function setCounter($counter)
    {
        $this->counter = $counter;

        return $this;
    }

    /**
     * Get counter
     *
     * @return integer
     */
    public function getCounter()
    {
        return $this->counter;
    }
    
    /**
     * Increment counter
     * 
     * @return \AppBundle\Entity\User
     */
    public function incrementCounter()
    {
        if ($this->counter < 2147483647) {
            $this->counter++;
        }
        
        return $this;
    }
}
