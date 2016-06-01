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

/**
 * Description of ProjectController
 *
 * @author toconuts <toconuts@gmail.com>
 * 
 * @Route("/member/project")
 */
class UserController extends Controller
{
    /**
     * @Route("", name="project_index")
     */
    public function indexAction()
    {
        $projects = $this->getDoctrine()->getRepository('AppBundle:Project')->findAll();
        return $this->render(
            'user/list.html.twig',
            array('projects' => $peojects)
        );
    }
    
    /**
     * @Route("/{id}", requirements = {"id" = "\d+"}, name="project_show")
     * @ParamConverter("project", class="AppBundle:Project")
     */
    public function showAction(Project $project)
    {   
        return $this->render(
            'user/show.html.twig',
            array('project' => $project)
        );
    }
    
    /**
     * @Route("/new", name="project_new")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function newAction()
    {
        // ...
    }
    
    /**
     * @Route("/{id}/edit", requirements = {"id" = "\d+"}, name="project_edit")
     * @ParamConverter("project", class="AppBundle:Project")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function editAction(Request $request, Project $project)
    {
        
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('user_list');
        }
        
        return $this->render(
            'user/edit.html.twig',
            array('form' => $form->createView())
        );
    }
    
    /**
     * @Route("/{id}", requirements = {"id" = "\d+"}, name="project_delete")
     * @Method({"DELETE"})
     * @ParamConverter("project", class="AppBundle:Project")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function unactiveAction(Project $project)
    {
        $project->setIsActive(false);
        $em = $this->getDoctrine()->getManager();
        $em->flush();
        
        return $this->redirectToRoute('user_list');
    }
}
