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
use Monolog\Logger;
use AppBundle\Controller\AbstractAppController;
use AppBundle\Entity\Project;
use AppBundle\Form\ProjectBaseType;
use AppBundle\Form\ProjectType;
use AppBundle\Entity\Document;
use AppBundle\Form\UploadDocumentType;
use AppBundle\Utils\ChoiceList\DocumentChoiceLoader;
use AppBundle\Utils\ChoiceList\CategoryChoiceLoader;
use AppBundle\Utils\ChoiceList\PresentationChoiceLoader;
use AppBundle\Utils\ChoiceList\OrganizationChoiceLoader;
use AppBundle\Service\StatisticsManager;

/**
 * Description of ProjectController
 *
 * @author toconuts <toconuts@gmail.com>
 * 
 * @Route("/member/project")
 */
class ProjectController extends AbstractAppController
{
    /**
     * @Route("", name="member_project_index")
     */
    public function indexAction(Request $request)
    {
        $dql   = "SELECT p FROM AppBundle:Project p INNER JOIN p.organization o ORDER BY p.updatedAt DESC";
        
        $em    = $this->getDoctrine()->getManager();
        $query = $em->createQuery($dql);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            Project::NUM_ITEMS // limit per page
        );
        
        return $this->render('project/index.html.twig', array(
            'pagination' => $pagination,
            'categoryChoices' => (new CategoryChoiceLoader())->getChoicesFliped(),
            'presentationChoices' => (new PresentationChoiceLoader())->getChoicesFliped(),
        ));
    }
    
    /**
     * @Route("/{id}", requirements = {"id" = "\d+"}, name="member_project_show")
     * @ParamConverter("project", class="AppBundle:Project")
     */
    public function showAction(Project $project)
    {
        $form = $this->createForm(ProjectBaseType::class, $project, array(
            'disabled' => true
        ));
        
        $documentChoices = (new DocumentChoiceLoader())->getChoicesFliped();
        
        return $this->render('project/show.html.twig', array(
                'project' => $project,
                'form' => $form->createView(),
                'students' => $project->getProjectMember(true),
                'teachers' => $project->getProjectMember(false),
                'documentChoices' =>$documentChoices,
        ));
    }
    
    /**
     * @Route("/new", name="member_project_new")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function newAction(Request $request)
    {
        $project = new Project();
        $project->setOrganization($this->getUser()->getOrganization());
        
        $organizations = $this->getDoctrine()->getRepository('AppBundle:Organization')->findAll();
        
        $disabled = ($this->get('security.authorization_checker')
                ->isGranted('ROLE_SUPER_ADMIN')) ? false : true;
        
        $form = $this->createForm(ProjectType::class, $project, array(
            'organization_disabled' => $disabled,
        ));
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($project);
            $em->flush();
            
            $url = $this->generateUrl('member_project_show', array('id' => $project->getId()));
            
            $this->log('created new project - ' . $project->getName() . '.', Logger::NOTICE, $url);

            return $this->redirect($url);
        }
        
        return $this->render('project/new.html.twig', array(
            'organizations' => $organizations,
            'form' => $form->createView()
        ));
    }
    
    /**
     * @Route("/{id}/edit", requirements = {"id" = "\d+"}, name="member_project_edit")
     * @ParamConverter("project", class="AppBundle:Project")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function editAction(Request $request, Project $project)
    {

        if (!$this->get('security.authorization_checker')
                ->isGranted('ROLE_SUPER_ADMIN')) {
            if (!($this->get('security.authorization_checker')
                    ->isGranted('ROLE_ADMIN') && 
                $this->getUser()->getOrganization()->getId() == 
                            $project->getOrganization()->getId())) {
                $this->createAccessDeniedException();
            }
        }
        
        $disabled = ($this->get('security.authorization_checker')
            ->isGranted('ROLE_SUPER_ADMIN')) ? false : true;
        
        $organizations = $this->getDoctrine()->getRepository('AppBundle:Organization')->findAll();
        
        $form = $this->createForm(ProjectType::class, $project, array(
            'organization_disabled' => $disabled,
        ));
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $url = $this->generateUrl('member_project_show', array('id' => $project->getId()));
            
            $this->log('updated project ' . $project->getName() . '.', Logger::NOTICE, $url);
            
            return $this->redirect($url);
        }
        
        return $this->render('project/edit.html.twig', array(
            'project' => $project,
            'organizations' => $organizations,
            'form' => $form->createView()
        ));
    }
    
    /**
     * @Route("/{id}/active", requirements = {"id" = "\d+"}, name="member_project_activate")
     * @Method({"ACTIVATE"})
     * @ParamConverter("project", class="AppBundle:Project")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function activateAction(Project $project)
    {
        $project->setIsActive(true);
        $em = $this->getDoctrine()->getManager();
        $em->flush();
        
        $this->log('activate project - ' . $project->getName() . '.', Logger::NOTICE,
                $this->generateUrl('member_project_show', array('id' => $project->getId())));
        
        return $this->redirectToRoute('member_project_index');
    }
    
    /**
     * @Route("/{id}/inactivate", requirements = {"id" = "\d+"}, name="member_project_inactivate")
     * @Method({"INACTIVATE"})
     * @ParamConverter("project", class="AppBundle:Project")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function inactiveAction(Project $project)
    {
        $project->setIsActive(false);
        dump($project);
        $em = $this->getDoctrine()->getManager();
        $em->flush();
        
        $this->log('inactivate project - ' . $project->getName() . '.', Logger::NOTICE,
                $this->generateUrl('member_project_show', array('id' => $project->getId())));
        
        return $this->redirectToRoute('member_project_index');
    }
    
    /**
     * @Route("/{id}/doc/{type}/upload", requirements = {"id" = "\d+", "type" = "\d+"}, name="member_project_document_upload")
     * @ParamConverter("project", class="AppBundle:Project")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function uploadDocumentAction(Request $request, Project $project, $type)
    {
        $document = $project->getDocumentsByType($type);
        if (!$document) {
            $document = new Document();
            $document->setProject($project);
            $document->setType($type);
        }
        
        $form = $this->createForm(UploadDocumentType::class, $document);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($document);
            $em->flush();
            
            $this->log('File upload completed.', Logger::INFO);
            
            return $this->redirectToRoute('member_project_show',
                array('id' => $project->getId()));
        }
        
        $documentChoice = (new DocumentChoiceLoader())->getChoicesFliped()[$type];
        return $this->render('project/upload_document.html.twig', array(
            'form' => $form->createView(),
            'project' => $project,
            'documentChoice' => $documentChoice,
        ));
    }
    
    public function toppageAction()
    {
        $project = $this->getDoctrine()->getManager()
                ->getRepository('AppBundle:Project')
                ->findBy(array('isActive' => true));

        return $this->render('components/member/project_toppage.html.twig', array(
            'project' => $project[mt_rand(0, count($project)-1)],
            'categoryChoices' => (new CategoryChoiceLoader())->getChoicesFliped(),
        ));
    }
    
    public function defaultpageAction()
    {
        $projects = $this->getDoctrine()->getManager()
                ->getRepository('AppBundle:Project')
                ->findAllSortedCategory();
        
        $sm = $this->get('app.statistics_manager');
        
        $projectStatics = $sm->getNumberOfRegisterdProjectGroupByType();
        
        dump($projectStatics);
        
        return $this->render('components/section_projects.html.twig', array(
            'projects'              => $projects,
            'projectStatics'        => $projectStatics,
            'categoryChoices'       => (new CategoryChoiceLoader())->getChoicesFliped(),
            'organizationChoices'   => (new OrganizationChoiceLoader())->getChoicesFliped(),
        ));
    }
}
