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

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use AppBundle\Entity\Project;
use AppBundle\Form\ProjectBaseType;
use AppBundle\Form\ProjectType;
use AppBundle\Entity\Document;
use AppBundle\Form\UploadDocumentType;
use AppBundle\Utils\ChoiceList\DocumentType;

/**
 * Description of ProjectController
 *
 * @author toconuts <toconuts@gmail.com>
 * 
 * @Route("/member/project")
 */
class ProjectController extends Controller
{
    /**
     * @Route("", name="member_project_index")
     */
    public function indexAction()
    {
        $projects = $this->getDoctrine()->getRepository('AppBundle:Project')->findAll();
        return $this->render(
            'project/index.html.twig',
            array('projects' => $projects)
        );
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
        $documentTypes = (new DocumentType())->getChoicesFliped();
        return $this->render('project/show.html.twig', array(
                'project' => $project,
                'form' => $form->createView(),
                'students' => $project->getProjectMember(true),
                'teachers' => $project->getProjectMember(false),
                'documentTypes' =>$documentTypes,
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
            dump($project->getUsers());
            $em = $this->getDoctrine()->getManager();
            $em->persist($project);
            $em->flush();

            return $this->redirectToRoute('member_project_show',
                array('id' => $project->getId()));
        }
        
        return $this->render(
            'project/new.html.twig',
            array(
                'organizations' => $organizations,
                'form' => $form->createView()
            )
        );
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
            dump($project->getOrganization());
            $em = $this->getDoctrine()->getManager();
            //$em->persist($project);
            $em->flush();

            return $this->redirectToRoute('member_project_show',
                array('id' => $project->getId()));
        }
        
        return $this->render(
            'project/edit.html.twig',
            array(
                'project' => $project,
                'organizations' => $organizations,
                'form' => $form->createView())
        );
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
        dump($document);
        
        $form = $this->createForm(UploadDocumentType::class, $document);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($document);
            $em->flush();
            dump($document);
            return $this->redirectToRoute('member_project_show',
                array('id' => $project->getId()));
        }
        
        $documentTypeName = (new DocumentType())->getChoicesFliped()[$type];
        return $this->render(
            'project/upload_document.html.twig', array(
                'form' => $form->createView(),
                'project' => $project,
                'documentTypeName' => $documentTypeName,
        ));
    }
}
