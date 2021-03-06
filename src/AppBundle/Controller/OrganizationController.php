<?php

/*
 * This file is part of the TJ-SIF 2016 project.
 *
 * (c) toconuts <toconuts@google.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Monolog\Logger;
use AppBundle\Controller\AbstractAppController;
use AppBundle\Entity\Organization;
use AppBundle\Form\OrganizationType;
use AppBundle\Utils\ChoiceList\OrganizationChoiceLoader;

/**
 * Description of OrganizationController
 *
 * @author toconuts <toconuts@gmail.com>
 * 
 * @Route("/member/org")
 */
class OrganizationController extends AbstractAppController
{
    /**
     * @Route("", name="member_organization_index")
     */
    public function indexAction(Request $request)
    {
        $dql   = "SELECT o FROM AppBundle:Organization o ORDER BY cast(o.type as Integer) ASC";
        
        $em    = $this->getDoctrine()->getManager();
        $query = $em->createQuery($dql);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            Organization::NUM_ITEMS // limit per page
        );
                
        return $this->render('organization/index.html.twig', array(
            'pagination' => $pagination,
            'organizationChoices'    => (new OrganizationChoiceLoader())->getChoicesFliped(),
        ));
    }
    
    /**
     * @Route("/{id}", requirements = {"id" = "\d+"}, name="member_organization_show")
     * @ParamConverter("organization", class="AppBundle:Organization")
     */
    public function showAction(Organization $organization)
    {   
        $form = $this->createForm(OrganizationType::class, $organization,
            array(
                'disabled' => true
            )
        );
        
        return $this->render(
            'organization/show.html.twig',
            array(
                'organization' => $organization,
                'form' => $form->createView()
            )
        );
    }
    
    /**
     * @Route("/new", name="member_organization_new")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function newAction(Request $request)
    {
        $organization = new Organization();
        $form = $this->createForm(OrganizationType::class, $organization);
        $form->add('sisters', EntityType::class, array(
            'class' => 'AppBundle:Organization',
            'choice_label' => 'name',
            'multiple' => true,
            'expanded' => true,
            'placeholder' => 'No sister school',
        )); // no need query because new organization has not stored yet.
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($organization);
            $em->flush();

            $url = $this->generateUrl('member_organization_show', array('id' => $organization->getId()));
            
            $this->log('created new organization - ' . $organization->getName() . '.', Logger::NOTICE, $url);
            
            return $this->redirect($url);

        }
        
        return $this->render('organization/new.html.twig', array(
            'form' => $form->createView()
        ));
    }
    
    /**
     * @Route("/{id}/edit", requirements = {"id" = "\d+"}, name="member_organization_edit")
     * @ParamConverter("organization", class="AppBundle:Organization")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function editAction(Request $request, Organization $organization)
    {
        
        $form = $this->createForm(OrganizationType::class, $organization);
        $form->add('sisters', EntityType::class, array(
            'class' => 'AppBundle:Organization',
            'choice_label' => 'name',
            'multiple' => true,
            'expanded' => true,
            'placeholder' => 'No sister school',
            'query_builder' => function (EntityRepository $er) use ($organization) {
                return $er->createQueryBuilder('o')
                    ->where('o.id != :id')
                    ->orderBy('o.type', 'ASC')
                    ->setParameter('id', $organization->getId());
            }, 
        ));
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $url = $this->generateUrl('member_organization_show', array('id' => $organization->getId()));
            
            $this->log('updated organization - ' . $organization->getName() . '.', Logger::NOTICE, $url);
            
            return $this->redirect($url);
        }
        
        return $this->render('organization/edit.html.twig', array(
                'organization' => $organization,
                'form' => $form->createView()
        ));
    }
    
    /**
     * @Route("/{id}/active", requirements = {"id" = "\d+"}, name="member_organization_activate")
     * @Method({"ACTIVATE"})
     * @ParamConverter("organization", class="AppBundle:Organization")
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     */
    public function activateAction(Organization $organization)
    {
        $organization->setIsActive(true);
        $em = $this->getDoctrine()->getManager();
        $em->flush();
        
        $this->log('activate organization - ' . $organization->getName() . '.', Logger::NOTICE,
                $this->generateUrl('member_organization_show', array('id' => $organization->getId())));
        
        return $this->redirectToRoute('member_organization_index');
    }
    
    /**
     * @Route("/{id}/inactivate", requirements = {"id" = "\d+"}, name="member_organization_inactivate")
     * @Method({"INACTIVATE"})
     * @ParamConverter("organization", class="AppBundle:Organization")
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     */
    public function inactiveAction(Organization $organization)
    {
        $organization->setIsActive(false);
        $em = $this->getDoctrine()->getManager();
        $em->flush();
        
        $this->log('inactivate organization - ' . $organization->getName() . '.', Logger::NOTICE,
                $this->generateUrl('member_organization_show', array('id' => $organization->getId())));
        
        return $this->redirectToRoute('member_organization_index');
    }
    
    public function toppageAction()
    {
        $organizations = $this->getDoctrine()->getManager()
                ->getRepository('AppBundle:Organization')
                ->findBy(array('isActive' => true));
        
        $organization = $organizations[mt_rand(0, count($organizations)-1)];
        
        return $this->render('components/member/organization_toppage.html.twig', array(
            'organization' => $organization,
            'organizationChoices' => (new OrganizationChoiceLoader())->getChoicesFliped(),
        ));
    }
}
