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
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\HttpFoundation\File\File;
use AppBundle\Entity\User;

/**
 * Description of Document
 *
 * @author toconuts <toconuts@gmail.com>
 * 
 * @ORM\Table(name="document")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @Vich\Uploadable
 */
class Document
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
     * @Vich\UploadableField(mapping="project_file", fileNameProperty="filename")
     * @Assert\NotBlank()
     * 
     * @var File
     */
    private $file;
    
    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $filename;

    /**
     * @ORM\ManyToOne(targetEntity="Project", inversedBy="documents")
     * @ORM\JoinColumn(name="project_id", referencedColumnName="id")
     */
    private $project;
    
    /**
     * @ORM\Column(type="string", length=10)
     * @Assert\NotNull()
     */
    private $type;
    
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
     * @Assert\Callback
     * 
     * @param ExecutionContextInterface $context
     */
    public function validate(ExecutionContextInterface $context)
    {
        dump($this->type);
        if ($this->type == '1' || $this->type == '3') {
            if (!in_array($this->file->getMimeType(), array(
                'application/msword',
            ))) {
                $context
                    ->buildViolation('Wrong file type (docx,doc)')
                    ->atPath('file')
                    ->addViolation()
                ;
            }
        }
        if ($this->type == '2' || $this->type == '4') {
            if (!in_array($this->file->getMimeType(), array(
                'application/pdf',
            ))) {
                $context
                    ->buildViolation('Wrong file type (pdf)')
                    ->atPath('file')
                    ->addViolation()
                ;
            }
        }
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
    public function setFile(File $file = null)
    {
        $this->file = $file;

        if ($file) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTime('now');
        }

        return $this;
    }
    
    /**
     * Get file
     * 
     * @return Project
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Document
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
     * Set filename
     *
     * @param string $filename
     *
     * @return Document
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * Get filename
     *
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Set project
     *
     * @param \AppBundle\Entity\Project $project
     *
     * @return Document
     */
    public function setProject(\AppBundle\Entity\Project $project = null)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * Get project
     *
     * @return \AppBundle\Entity\Project
     */
    public function getProject()
    {
        return $this->project;
    }
}
