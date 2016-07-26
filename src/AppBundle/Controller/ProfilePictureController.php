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
use AppBundle\Entity\ProfilePicture;
use AppBundle\Form\UploadPictureType;
use AppBundle\Entity\User;

/**
 * Description of ProfilePictureController
 *
 * @author toconuts <toconuts@gmail.com>
 * 
 * @Route("/member/user")
 */
class ProfilePictureController extends AbstractAppController
{
    /**
     * @Route("/{id}/picture/upload", requirements = {"id" = "\d+"}, name="member_user_picture_upload")
     * @ParamConverter("user", class="AppBundle:User")
     */
    public function uploadAction(Request $request, User $user)
    {
        $picture = $user->getPicture();

        if (null == $picture)
            $picture = new ProfilePicture();

        $form = $this->createForm(UploadPictureType::class, $picture);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            $em = $this->getDoctrine()->getManager();
        
            if (null == $user->getPicture()) {
                //$user->setPicture($picture);
                $picture->setUser($user);
                $em->persist($picture);
            }
            $em->flush();
            
            $this->log('updated profile picture.', Logger::INFO);

            return $this->redirectToRoute('member_user_show', array(
                'id' => $user->getId()
            ));
        }
        
        return $this->render('user/upload_picture.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
