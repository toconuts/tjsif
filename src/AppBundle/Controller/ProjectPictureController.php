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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\ProjectPicture;
use AppBundle\Form\UploadPictureType;
use AppBundle\Entity\Project;

/**
 * Description of ProjectPictureController
 *
 * @author toconuts <toconuts@gmail.com>
 * 
 * @Route("/member/project")
 */
class ProjectPictureController extends Controller
{
    /**
     * @Route("/{id}/picture/upload", requirements = {"id" = "\d+"}, name="member_project_picture_upload")
     * @ParamConverter("project", class="AppBundle:Project")
     */
    public function uploadAction(Request $request, Project $project)
    {
        $picture = $project->getPicture();

        if (null == $picture)
            $picture = new ProjectPicture();

        $form = $this->createForm(UploadPictureType::class, $picture);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            dump($form);
            
            $em = $this->getDoctrine()->getManager();
        
            if (null == $project->getPicture()) {
                $picture->setProject($project);
                $em->persist($picture);
            }
            $em->flush();
            
//TODO: Add Flash

            return $this->redirectToRoute('member_project_show',
                array('id' => $project->getId()));
        }
        
        return $this->render(
            'project/upload_picture.html.twig',
            array(
                'form' => $form->createView(),
                'project' => $project
                )
            );
    }
}
