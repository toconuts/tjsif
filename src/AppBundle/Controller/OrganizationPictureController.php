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

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Monolog\Logger;
use AppBundle\Controller\AbstractAppController;
use AppBundle\Entity\OrganizationPicture;
use AppBundle\Form\UploadPictureType;
use AppBundle\Entity\Organization;

/**
 * Description of OrganizationPictureController
 *
 * @author toconuts <toconuts@gmail.com>
 * 
 * @Route("/member/org")
 */
class OrganizationPictureController extends AbstractAppController
{
    /**
     * @Route("/{id}/picture/upload", requirements = {"id" = "\d+"}, name="member_organization_picture_upload")
     * @ParamConverter("organization", class="AppBundle:Organization")
     */
    public function uploadAction(Request $request, Organization $organization)
    {
        $picture = $organization->getPicture();

        if (null == $picture)
            $picture = new OrganizationPicture();

        $form = $this->createForm(UploadPictureType::class, $picture);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            dump($form);
            
            $em = $this->getDoctrine()->getManager();
        
            if (null == $organization->getPicture()) {
                $picture->setOrganization($organization);
                $em->persist($picture);
            }
            $em->flush();
            
            $this->log('updated organization picture.', Logger::INFO);

            return $this->redirectToRoute('member_organization_show', array(
                'id' => $organization->getId()
            ));
        }
        
        return $this->render('organization/upload_picture.html.twig', array(
            'form' => $form->createView(),
            'organization' => $organization
        ));
    }
}
