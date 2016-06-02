<?php

/*
 * This file is part of the TJ-SIF 2016 project.
 *
 * (c) toconuts <toconuts@google.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Service;

use Vich\UploaderBundle\Naming\DirectoryNamerInterface;
use Vich\UploaderBundle\Mapping\PropertyMapping;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

/**
 * Description of ProfilePictureDirectoryNamer
 *
 * @author toconuts <toconuts@gmail.com>
 */
class ProfilePictureDirectoryNamer implements DirectoryNamerInterface
{
    protected $tokenStorage;
    
    public function __construct(TokenStorage $tokenStrage)
    {
        $this->tokenStorage = $tokenStrage;
    }
    
    /**
     * {@inheritDoc}
     */
    public function directoryName($object, PropertyMapping $mapping)
    {
        return $this->getUser()->getOrganization()->getId();
    }
    
    protected function getUser()
    {
        return $this->tokenStorage->getToken()->getUser();
    }
}
