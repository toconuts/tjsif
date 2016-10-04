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

use Doctrine\ORM\EntityManager;
use AppBundle\Entity\User;
use AppBundle\Entity\Role;
use AppBundle\Utils\ChoiceList\OccupationChoiceLoader;
use AppBundle\Utils\ChoiceList\OrganizationChoiceLoader;
use AppBundle\Utils\ChoiceList\AccountChoiceLoader;

/**
 * Description of RoleManager
 *
 * @author toconuts <toconuts@gmail.com>
 */
class RoleManager
{
    /**
     * Entity Manager
     * 
     * @var EntityManager
     */
    private $entityManager;
    
    private $sadminMails;
    
    public function __construct(EntityManager $entityManager, array $sadminMails)
    {
        $this->entityManager = $entityManager;
        $this->sadminMails = $sadminMails;
    }
    
    /**
     * Update user roles (no flush)
     * 
     * ROLE_USER: Everyone
     * ROLE_POWER_USER: the other people who can edit their organization
     * ROLE_ADMIN: JOCV and Teachers who can create and edit project and activation their student
     *              Thai: Teacher who is a paticipant
     *              Japanese: Every teacher
     * ROLE_ADMIN: Only people who are specified parameters
     * 
     * @param User $user
     */
    public function updateRoles(User $user)
    {
        $user = $this->removeAllRoles($user);
        
        // ROLE_USER (All user) 
        $user = $this->grantRoleUser($user);        
        
        // ROLE_POWER_USER
        if ($user->getOccupation() == OccupationChoiceLoader::OCCUPATION_THEOTHER_ID) {
            if ($user->getOrganization()->getType() != OrganizationChoiceLoader::ORGANIZATION_FORM_12_PCSHS_ID &&
                $user->getOrganization()->getType() != OrganizationChoiceLoader::ORGANIZATION_FORM_SSHS_JAPAN_ID &&
                $user->getOrganization()->getType() != OrganizationChoiceLoader::ORGANIZATION_FORM_SISTER_THAI_ID) {
            
                $user = $this->grantRolePowerUser($user);
            }
        }
        
        // ROLE_ADMIN
        if ($user->getOccupation() == OccupationChoiceLoader::OCCUPATION_JOCV_ID) {
            
            $user = $this->grantRoleAdmin($user);
            
        } else if ($user->getOccupation() == OccupationChoiceLoader::OCCUPATION_TEACHER_ID ||
                $user->getOccupation() == OccupationChoiceLoader::OCCUPATION_DEPUTY_ID ||
                $user->getOccupation() == OccupationChoiceLoader::OCCUPATION_DIRECTOR_ID) {
            
            if ($user->getType() == AccountChoiceLoader::ACCOUNT_CONTACT_PERSON_ID || $user->getType() == AccountChoiceLoader::ACCOUNT_CONTACT_PERSON_NA_ID) {
            
                $user = $this->grantRoleAdmin($user);
                
            } else if (($user->getOrganization()->getCountry() == 'JP') ||
                ($user->getOrganization()->getCountry() == 'TH' && 
                    $user->getType() == AccountChoiceLoader::ACCOUNT_PARTICIPANT_ID)) {
                
                $user = $this->grantRoleAdmin($user);
                
            } 
        }
        
        // ROLE_SUPER_ADMIN
        if (in_array($user->getEmail(), $this->sadminMails)) {
            
            $user = $this->grantRoleSuperAdmin($user);
            
        }

        return $user;
    }
    
    protected function removeAllRoles($user)
    {
        $roles = $user->getUserRoles();
        foreach ($roles as $role) {
            $user->removeRole($role);
        }
        
        return $user;
    }
    
    protected function grantRole(User $user, $rolename)
    {
        $role = $this->entityManager->getRepository('AppBundle:Role')->findOneBy(array('role' => $rolename));
        $user->addRole($role);
        
        return $user;
    }
    
    protected function grantRoleUser(User $user)
    {
        return $this->grantRole($user, 'ROLE_USER');
    }
    
    protected function grantRolePowerUser(User $user)
    {
        return $this->grantRole($user, 'ROLE_POWER_USER');
    }
    
    protected function grantRoleAdmin(User $user)
    {
        return $this->grantRole($user, 'ROLE_ADMIN');
    }
    
    protected function grantRoleSuperAdmin(User $user)
    {
        return $this->grantRole($user, 'ROLE_SUPER_ADMIN');
    }
}
