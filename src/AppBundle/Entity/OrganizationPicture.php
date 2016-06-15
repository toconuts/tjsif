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
use AppBundle\Entity\Organization;
use AppBundle\Entity\BasePicture;

/**
 * Description of OrganizationPicture
 *
 * @author toconuts <toconuts@gmail.com>
 * 
 * @ORM\Table(name="organization_picture")
 * @ORM\Entity
 */
class OrganizationPicture extends BasePicture
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\OneToOne(targetEntity="Organization", inversedBy="picture")
     * @ORM\JoinColumn(name="organization_id", referencedColumnName="id")
     */
    private $organization;
    
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
}
