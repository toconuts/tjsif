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
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use AppBundle\Entity\Organization;

/**
 * Description of OrganizationPicture
 *
 * @author toconuts <toconuts@gmail.com>
 * 
 * @ORM\Table(name="organization_picture")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @Vich\Uploadable
 */
class OrganizationPicture
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * 
     * @Vich\UploadableField(mapping="organization_picture", fileNameProperty="imageName")
     * @Assert\NotBlank()
     * 
     * @var File
     */
    private $imageFile;
    
    /**
     * @ORM\OneToOne(targetEntity="Organization", inversedBy="picture")
     * @ORM\JoinColumn(name="organization_id", referencedColumnName="id")
     */
    private $organization;
    
    /**
     * @ORM\Column(name="image_name", type="string", length=255)
     *
     * @var string
     */
    private $imageName;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;
    
    /**
     * @ORM\Column(type="datetime")
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
    
    public function __construct()
    {
        
    }
    
    /**
     * @param string $imageName
     *
     * @return Product
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;

        return $this;
    }

    /**
     * @return string
     */
    public function getImageName()
    {
        return $this->imageName;
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
     * 
     * @param \DateTime $updatedAt
     * @return ProfilePicture
     */
    public function setUpdatedAt($updatedAt = null)
    {
        if ($updatedAt) {
            $this->updatedAt = new \DateTime();
        } else {
            $this->updatedAt = $updatedAt;
        }
        
        return $this;
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
     * @return ProfilePicture
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
     * @return ProfilePicture
     */
    public function setUpdatedBy(\AppBundle\Entity\User $updatedBy = null)
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }
    
    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * Set organization
     *
     * @param \AppBundle\Entity\Project $organization
     *
     * @return OrganizationPicture
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
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     *
     * @return Product
     */
    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        if ($image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTime('now');
        }

        return $this;
    }

    /**
     * @return File
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }
}
