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
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Entity\Project;
use AppBundle\Form\ProjectType;
//use AppBundle\Entity\User;
//use AppBundle\Entity\Job;

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
        $form = $this->createForm(ProjectType::class, $project, array(
            'disabled' => true
        ));
        
        return $this->render(
            'project/show.html.twig',
            array(
                'project' => $project,
                'form' => $form->createView()
            )
        );
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

//TODO: {% if is_granted('ROLE_SUPER_ADMIN') or (is_granted('ROLE_ADMIN') and app.user.id == project.organization.id) %}
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
     * @Route("/test")
     */
    public function testAction()
    {
        $organizations = $this->getDoctrine()->getRepository('AppBundle:Organization')->findAll();
        return $this->render(
            'project/choice_member.html.twig',
            array('organizations' => $organizations,)
        );
    }
}
