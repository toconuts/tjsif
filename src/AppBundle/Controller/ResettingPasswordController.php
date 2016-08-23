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
use Monolog\Logger;
use AppBundle\Controller\AbstractAppController;
use AppBundle\Entity\User;
use AppBundle\Entity\ResettingPassword;
use AppBundle\Form\Model\RequestResettingPassword;
use AppBundle\Form\RequestPasswordType;
use AppBundle\Form\ResetPasswordType;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Description of ResettingPasswordController
 *
 * @author toconuts
 */
class ResettingPasswordController extends AbstractAppController
{
    /**
     * @Route("/request", name="user_resetting_password_request")
     */
    public function requestAction(Request $request)
    {
        $requestResettingPwd = new RequestResettingPassword();
        
        $form = $this->createForm(RequestPasswordType::class, $requestResettingPwd);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $rm = $this->get('app.registration_manager');            
            
            $user = $rm->getUser($requestResettingPwd->getEmail());
            if (!$user) {
                $this->log('Email address \"' . $requestResettingPwd->getEmail() . '\" does not exist.\"', Logger::ERROR);
                return $this->redirectToRoute('user_resetting_password_request');
            }
            
            try {
                
                $rm->requestResettingPassword($user);
                
                return $this->render('resetting_password/check_email.html.twig', array(
                    'email' => $user->getEmail(),
                ));
            
            } catch (\Exception $e) {
                $this->log($e->getMessage(), Logger::ERROR);                
            }
        }
        
        return $this->render('resetting_password/request.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    
    /**
     * @Route("/reset", name="user_resetting_password_reset")
     */
    public function resetAction(Request $request)
    {

        $rm = $this->get('app.registration_manager');

        $confirmationToken = $request->query->get('key');
        $resettingPwd = $rm->getResettingPassword($confirmationToken);
        if (!$resettingPwd) {
            return $this->render('resetting_password/invalid_confirmation_token.html.twig', array(
                    'confirmation_token' => $confirmationToken,
            ));
        }
        
        $form = $this->createForm(ResetPasswordType::class, $resettingPwd);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                
                $rm->resetPassword($resettingPwd);
                
                return $this->redirect('login');
            
            } catch (\Exception $e) {
                $this->log($e->getMessage(), Logger::ERROR);                
            }
        }
        
        return $this->render('resetting_password/reset.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    
}
