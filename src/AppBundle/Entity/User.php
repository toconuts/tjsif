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
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Entity\ProfilePicture;

/**
 * Description of User
 *
 * @author toconuts <toconuts@gmail.com>
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\UserRepository")
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity(fields="email", message="Email already taken")
 */
class User implements AdvancedUserInterface, \Serializable
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=60, unique=true)
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $password;

    /**
     * @Assert\NotBlank(groups={"registration"})
     * @Assert\Length(max=4096, groups={"registration"})
     */
    private $plainPassword;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    /**
     * @ORM\ManyToMany(targetEntity="Role", inversedBy="users")
     */
    private $roles;

    /**
     * @ORM\Column(type="string", length=10)
     * @Assert\NotBlank()
     */
    private $title;
    
    /**
     * @ORM\Column(type="string", length=25)
     * @Assert\NotBlank()
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=25, nullable=true)
     */
    private $middlename;

    /**
     * @ORM\Column(type="string", length=25)
     * @Assert\NotBlank()
     */
    private $lastname;
    
    /**
     * @ORM\Column(type="string", length=10)
     */
    private $gender;

    /**
     * @ORM\Column(type="string", length=60, nullable=true)
     * @Assert\Regex(pattern="/^\d+(-\d+)*$/")
     */
    private $tel;

    /**
     * @ORM\ManyToOne(targetEntity="Job", inversedBy="users")
     * @ORM\JoinColumn(name="job_id", referencedColumnName="id")
     */
    private $job;

    /**
     * @ORM\ManyToOne(targetEntity="Organization", inversedBy="users")
     * @ORM\JoinColumn(name="organization_id", referencedColumnName="id")
     */
    private $organization;

    /**
     * @ORM\ManyToMany(targetEntity="Project", inversedBy="users")
     */
    private $projects;
    
    /**
     * @ORM\Column(type="string", length=10)
     */
    private $type;
    
    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $position;
    
    /**
     * @ORM\OneToOne(targetEntity="ProfilePicture", mappedBy="user")
     */
    private $picture;
    
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
     * @Assert\Country()
     */
    private $country;
    
    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     * @Assert\Regex(pattern="/^\d+(-\d+)*$/")
     */
    private $zip;
    
    /**
     * @ORM\Column(name="about_me", type="string", length=255, nullable=true)
     */
    private $aboutMe;
    
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $allergies;
    
    /**
     * @ORM\OneToMany(targetEntity="Invitation", mappedBy="invitedBy")
     */
    private $invitations;
    
    /**
     * @ORM\Column(name="activation_key", type="string", length=100, nullable=true)
     */
    private $activationKey;
    
    /**
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    private $updatedAt;


    public function __construct()
    {
        $this->isActive = true;
        $this->roles = new ArrayCollection();
        $this->projects = new ArrayCollection();
 //       $this->picture = new ProfilePicture();
    }

    /**
     * @return bool
     */
    public function isUser(User $user = null)
    {
        return $user && $user->getId() == $this->getId();
    }
    
    public function getFullname()
    {
        return $this->firstname . " " . $this->lastname;
    }
    
    public function getFullnamewithTitle()
    {
        return $this->title . " " . $this->firstname . " " . $this->lastname;
    }
    
    /**
     * @inheritdoc
     */
    public function getRoles()
    {
        return $this->roles->toArray();
    }

    /**
     * Get roles.
     * 
     * @return (Role|ArrayCollection) The user roles
     */
    public function getUserRoles()
    {
        return $this->roles;
    }

    /**
     * @inheritdoc
     */
    public function eraseCredentials()
    {
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->email,
            $this->password,
            $this->isActive,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->email,
            $this->password,
            $this->isActive,
        ) = unserialize($serialized);
    }

    /** @see ArrayCollection::isEnabled() */
    public function isEnabled()
    {
        return $this->isActive;
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
     * Set username
     * User have only email property for login (no username).
     *
     * @param string $email
     *
     * @return User
     */
    public function setUsername($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get username
     * User have only email property for login (no username).
     *
     * @inheritdoc
     */
    public function getUsername()
    {
        return $this->email;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
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
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set plainPassword
     *
     * @param type $password
     * @return User
     */
    public function setPlainPassword($password)
    {
        $this->plainPassword = $password;

        return $this;
    }

    /**
     * Get plainPassword
     *
     * @return string
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
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
     * @inheritdoc
     */
    public function isAccountNonExpired()
    {
        return true;
    }

    /**
     * @inheritdoc
     */
    public function isAccountNonLocked()
    {
        return true;
    }

    /**
     * @inheritdoc
     */
    public function isCredentialsNonExpired()
    {
        return true;
    }

    /**
     * @inheritdoc
     */
    public function getSalt()
    {
        // it's not used because bcrypt does this internally.
        return null;
    }

    /**
     * Add role
     *
     * @param \AppBundle\Entity\Role $role
     *
     * @return User
     */
    public function addRole(\AppBundle\Entity\Role $role)
    {
        $this->roles[] = $role;

        return $this;
    }

    /**
     * Remove role
     *
     * @param \AppBundle\Entity\Role $role
     */
    public function removeRole(\AppBundle\Entity\Role $role)
    {
        $this->roles->removeElement($role);
    }

    /**
     * Set fisrtname
     *
     * @param string $firstname
     *
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set middlename
     *
     * @param string $middlename
     *
     * @return User
     */
    public function setMiddlename($middlename)
    {
        $this->middlename = $middlename;

        return $this;
    }

    /**
     * Get middlename
     *
     * @return string
     */
    public function getMiddlename()
    {
        return $this->middlename;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return User
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set tel
     *
     * @param string $tel
     *
     * @return User
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
     * Set Organization
     *
     * @param Organization $organization
     *
     * @return User
     */
    public function setOrganization(Organization $organization = null)
    {
        $this->organization = $organization;

        return $this;
    }

    /**
     * Get Organization
     *
     * @return Organization
     */
    public function getOrganization()
    {
        return $this->organization;
    }

    /**
     * Set job
     *
     * @param \AppBundle\Entity\Job $job
     *
     * @return User
     */
    public function setJob(\AppBundle\Entity\Job $job = null)
    {
        $this->job = $job;

        return $this;
    }

    /**
     * Get job
     *
     * @return \AppBundle\Entity\Job
     */
    public function getJob()
    {
        return $this->job;
    }

    /**
     * Set picture
     *
     * @param ProfilePicture $picture
     *
     * @return User
     */
    public function setPicture(ProfilePicture $picture)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture
     *
     * @return ProfilePicture
     */
    public function getPicture()
    {
        return $this->picture;
    }
    
    /**
     * Set position
     *
     * @param string $position
     *
     * @return User
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return string
     */
    public function getPosition()
    {
        return $this->position;
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
     * Set activationKey
     *
     * @param string $activationKey
     *
     * @return User
     */
    public function setActivationKey($activationKey)
    {
        $this->activationKey = $activationKey;

        return $this;
    }

    /**
     * Get activationKey
     *
     * @return string
     */
    public function getActivationKey()
    {
        return $this->activationKey;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return User
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Add invitation
     *
     * @param \AppBundle\Entity\Invitation $invitation
     *
     * @return User
     */
    public function addInvitation(\AppBundle\Entity\Invitation $invitation)
    {
        $this->invitations[] = $invitation;

        return $this;
    }

    /**
     * Remove invitation
     *
     * @param \AppBundle\Entity\Invitation $invitation
     */
    public function removeInvitation(\AppBundle\Entity\Invitation $invitation)
    {
        $this->invitations->removeElement($invitation);
    }

    /**
     * Get invitations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getInvitations()
    {
        return $this->invitations;
    }

    /**
     * Set gender
     *
     * @param string $gender
     *
     * @return User
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return User
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
     * Set city
     *
     * @param string $city
     *
     * @return User
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
     * @return User
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
     * @return User
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
     * @return User
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
     * Set aboutMe
     *
     * @param string $aboutMe
     *
     * @return User
     */
    public function setAboutMe($aboutMe)
    {
        $this->aboutMe = $aboutMe;

        return $this;
    }

    /**
     * Get aboutMe
     *
     * @return string
     */
    public function getAboutMe()
    {
        return $this->aboutMe;
    }

    /**
     * Set homepage
     *
     * @param string $homepage
     *
     * @return User
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
     * @return User
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
     * Set allergies
     *
     * @param string $allergies
     *
     * @return User
     */
    public function setAllergies($allergies)
    {
        $this->allergies = $allergies;

        return $this;
    }

    /**
     * Get allergies
     *
     * @return string
     */
    public function getAllergies()
    {
        return $this->allergies;
    }

    /**
     * Set address1
     *
     * @param string $address1
     *
     * @return User
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
     * @return User
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
     * Add project
     *
     * @param \AppBundle\Entity\Project $project
     *
     * @return User
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
}
