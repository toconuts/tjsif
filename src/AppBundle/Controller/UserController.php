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
use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use AppBundle\Form\ChangePasswordType;
use AppBundle\Form\Model\ChangePassword;
use AppBundle\Utils\ChoiceList\OccupationChoiceLoader;
use AppBundle\Utils\ChoiceList\AccountChoiceLoader;

/**
 * Description of UserController
 *
 * @author toconuts <toconuts@gmail.com>
 * 
 * @Route("/member/user")
 */
class UserController extends AbstractAppController
{
    /**
     * @Route("", name="member_user_index")
     */
    public function indexAction()
    {
        $users = $this->getDoctrine()->getRepository('AppBundle:User')
                    ->findUserSortedByOrganization();

        return $this->render('user/index.html.twig', array(
            'memberlist' => $users,
            'occupationChoices'    => (new OccupationChoiceLoader())->getChoicesFliped(),
            'accountChoices'    => (new AccountChoiceLoader())->getChoicesFliped(),
        ));
    }
    
    /**
     * @Route("/{id}", requirements = {"id" = "\d+"}, name="member_user_show")
     * @ParamConverter("user", class="AppBundle:User")
     */
    public function showAction(User $user)
    {   
        $form = $this->createForm(
            UserType::class,
            $user,
            array(
                'disabled' => true
            )
        );
        
        return $this->render(
            'user/show.html.twig',
            array('user' => $user,
                'form' => $form->createView()
            )
        );
    }
    
    /**
     * @Route("/{id}/edit", requirements = {"id" = "\d+"}, name="member_user_edit")
     * @ParamConverter("user", class="AppBundle:User")
     */
    public function editAction(Request $request, User $user)
    {
        if (!$user->isUser($this->getUser())) {
            throw $this->denyAccessUnlessGranted('edit', $user);
        }
        
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('app.role_manager')->updateRoles($user);
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $url = $this->generateUrl('member_user_show', array('id' => $user->getId()));
            
            $this->log('updated own profile.', Logger::NOTICE, $url);
            
            return $this->redirect($url);
        }
        
        return $this->render('user/edit.html.twig', array(
            'form' => $form->createView())
        );
    }
    
    /**
     * @Route("/{id}/active", requirements = {"id" = "\d+"}, name="member_user_activate")
     * @Method({"ACTIVATE"})
     * @ParamConverter("user", class="AppBundle:User")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function activateAction(User $user)
    {
        $user->setIsActive(true);
        $em = $this->getDoctrine()->getManager();
        $em->flush();
        
        $this->log('activate user - ' . $user->getFullname() . '.', Logger::NOTICE,
                $this->generateUrl('member_user_show', array('id' => $user->getId())));
        
        return $this->redirectToRoute('member_user_index');
    }
    
    /**
     * @Route("/{id}/inactive", requirements = {"id" = "\d+"}, name="member_user_inactivate")
     * @Method({"INACTIVATE"})
     * @ParamConverter("user", class="AppBundle:User")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function inactivateAction(User $user)
    {
        $user->setIsActive(false);
        $em = $this->getDoctrine()->getManager();
        $em->flush();
        
        $this->log('inactivate user - ' . $user->getFullname() . '.', Logger::NOTICE,
                $this->generateUrl('member_user_show', array('id' => $user->getId())));
        
        return $this->redirectToRoute('member_user_index');
    }
    
    /**
     * @Route("/{id}/delete", requirements = {"id" = "\d+"}, name="member_user_delete")
     * @Method({"DELETE"})
     * @ParamConverter("user", class="AppBundle:User")
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     */
    public function deleteAction(User $user)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();
        
        return $this->redirectToRoute('member_user_index');
    }
    
    /**
     * @Route("/{id}/changepassword", requirements = {"id" = "\d+"}, name="member_user_changepassword")
     * @ParamConverter("user", class="AppBundle:User")
     */
    public function changePasswdAction(Request $request, User $user)
    {
        $changePasswordModel = new ChangePassword();
        $form = $this->createForm(ChangePasswordType::class, $changePasswordModel);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $encoder = $this->get('security.password_encoder');
            $password = $encoder->encodePassword($user, $changePasswordModel->getNewPassword());
            $user->setPassword($password);
            
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            
            $url = $this->generateUrl('member_user_show', array('id' => $user->getId()));

            $this->log('updated your password', Logger::INFO, $url);

            return $this->redirect($url);
        }

        return $this->render('user/change_password.html.twig', array(
            'form' => $form->createView())
        );
    }
    
    public function toppageAction()
    {
        $users = $this->getDoctrine()->getManager()
                ->getRepository('AppBundle:User')
                ->findBy(array('isActive' => true));
        
        $user = $users[mt_rand(0, count($users)-1)];
        
        return $this->render('components/member/user_toppage.html.twig', array(
            'user' => $user,
            'occupationChoices' => (new OccupationChoiceLoader())->getChoicesFliped(),
        ));
    }
}
