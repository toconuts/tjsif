<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Entity\ProjectPicture;

/**
 * Project
 *
 * @author toconuts <toconuts@gmail.com>
 * 
 * @ORM\Table(name="project")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Project 
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
     * @ORM\Column(type="text", nullable=true)
     */
    private $concept;
    
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $objective;
    
    /**
     * @ORM\Column(type="string", length=10)
     * @Assert\NotNull()
     */
    private $topic;
    
    /**
     * @ORM\Column(type="string", length=10)
     * @Assert\NotNull
     */
    private $style;
    
    /**
     * @ORM\ManyToOne(targetEntity="Organization", inversedBy="projects")
     * @ORM\JoinColumn(name="organization_id", referencedColumnName="id")
     * @Assert\NotNull()
     */
    private $organization;
    
    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;
    
    /**
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    private $updatedAt;
    
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
     * @ORM\ManyToMany(targetEntity="User", inversedBy="projects")
     */
    private $users;
    
    /**
     * @ORM\OneToOne(targetEntity="ProjectPicture", mappedBy="project")
     */
    private $picture;
    
    /**
     * @ORM\OneToMany(targetEntity="Document", mappedBy="project")
     * @ORM\OrderBy({"type" = "ASC"})
     */
    private $documents;
    
    /**
     * @ORM\Column(type="integer")
     */
    private $counter;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->documents = new ArrayCollection();
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
     * @return project
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
     * @return project
     */
    public function addUser(\AppBundle\Entity\User $user)
    {
        $user->addProject($this);
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
        $user->removeProject($this);
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
     * Set concept
     *
     * @param string $concept
     *
     * @return Project
     */
    public function setConcept($concept)
    {
        $this->concept = $concept;

        return $this;
    }

    /**
     * Get concept
     *
     * @return string
     */
    public function getConcept()
    {
        return $this->concept;
    }

    /**
     * Set objective
     *
     * @param string $objective
     *
     * @return Project
     */
    public function setObjective($objective)
    {
        $this->objective = $objective;

        return $this;
    }

    /**
     * Get objective
     *
     * @return string
     */
    public function getObjective()
    {
        return $this->objective;
    }

    /**
     * Set topic
     *
     * @param string $topic
     *
     * @return Project
     */
    public function setTopic($topic)
    {
        $this->topic = $topic;

        return $this;
    }

    /**
     * Get topic
     *
     * @return string
     */
    public function getTopic()
    {
        return $this->topic;
    }

    /**
     * Set organization
     *
     * @param \AppBundle\Entity\Organization $organization
     *
     * @return Project
     */
    public function setOrganization(\AppBundle\Entity\Organization $organization = null)
    {
        $this->organization = $organization;

        return $this;
    }

    /**
     * Get organization
     *
     * @return \AppBundle\Entity\Organization
     */
    public function getOrganization()
    {
        return $this->organization;
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
     * @return Project
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
     * @return Project
     */
    public function setUpdatedBy(\AppBundle\Entity\User $updatedBy = null)
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }
    
    public function getProjectMember($isStudent)
    {
        $members = new ArrayCollection();
        foreach ($this->users as $member) {
            if ($isStudent && $member->getOccupation() == 1) {
                $members[] = $member;
            } else if (!$isStudent && $member->getOccupation() != 1){
                $members[] = $member;
            }
        }
        return $members;
    }

    /**
     * Set style
     *
     * @param string $style
     *
     * @return Project
     */
    public function setStyle($style)
    {
        $this->style = $style;

        return $this;
    }

    /**
     * Get style
     *
     * @return string
     */
    public function getStyle()
    {
        return $this->style;
    }

    /**
     * Set picture
     *
     * @param \AppBundle\Entity\ProfilePicture $picture
     *
     * @return Project
     */
    public function setPicture(\AppBundle\Entity\ProfilePicture $picture = null)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture
     *
     * @return \AppBundle\Entity\ProfilePicture
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Add document
     *
     * @param \AppBundle\Entity\Document $document
     *
     * @return Project
     */
    public function addDocument(\AppBundle\Entity\Document $document)
    {
        $this->documents[] = $document;

        return $this;
    }

    /**
     * Remove document
     *
     * @param \AppBundle\Entity\Document $document
     */
    public function removeDocument(\AppBundle\Entity\Document $document)
    {
        $this->documents->removeElement($document);
    }

    /**
     * Get documents
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDocuments()
    {
        return $this->documents;
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
    
    public function getDocumentsByType($type)
    {
        foreach ($this->documents as $document) {
            if ($type == $document->getType())
                return $document;
        }
        return null;
    }
}
