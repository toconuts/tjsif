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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Monolog\Logger;
use AppBundle\Controller\AbstractAppController;
use AppBundle\Entity\User;
use AppBundle\Form\Model\FactoryTour;
use AppBundle\Utils\ChoiceList\FactoryTourChoiceLoader;
use AppBundle\Utils\ChoiceList\OccupationChoiceLoader;

/**
 * Description of FactoryTourController
 *
 * @author toconuts <toconuts@gmail.com>
 * 
 * @Route("/member/factorytour")
 */
class FactoryTourController extends AbstractAppController
{
    
    /**
     * @Route("/{id}", requirements = {"id" = "\d+"}, name="member_factorytour_show")
     * @ParamConverter("user", class="AppBundle:User")
     */
    public function showAction(User $user)
    {
        $fm = $this->get('app.factorytour_manager');
        $attendance = $fm->getAttendance($user);

        if ($this->get('security.authorization_checker')->isGranted('ROLE_SUPER_ADMIN') && !$user->isUser($this->getUser())) {
            if (!$attendance) {
                return $this->redirectToRoute('member_factorytour_new', array('id' => $user->getId()));
            }
        }
        
        
        $fm = $this->get('app.factorytour_manager');
        $factoryTour = new FactoryTour();
        $factoryTour = $fm->updateNumbersOfRegisters($factoryTour);
        
        return $this->render('factorytour/show.html.twig', array(
            'attendance' => $attendance,
            'user' => $user,
            'factoryTour' => $factoryTour,
            'occupationChoices'    => (new OccupationChoiceLoader())->getChoicesFliped(),
        ));
    }
    
    /**
     * @Route("/{id}/new", requirements = {"id" = "\d+"}, name="member_factorytour_new")
     * @ParamConverter("user", class="AppBundle:User")
     */
    public function newAction(Request $request, User $user)
    {
        if (!($this->get('security.authorization_checker')->isGranted('ROLE_SUPER_ADMIN') && !$user->isUser($this->getUser()))) {
            throw $this->denyAccessUnlessGranted('edit', $user);
        }
        
        $fm = $this->get('app.factorytour_manager');
        $attendance = $fm->getAttendance($user);
        if ($attendance) {
            return $this->redirectToRoute('member_factorytour_show', array('id' => $user->getId()));
        }
                
        $factoryTour = new FactoryTour();
        $factoryTour = $fm->updateNumbersOfRegisters($factoryTour);
        
        $form = $this->createFormBuilder($factoryTour)
            ->add('company', ChoiceType::class, array(
                'choice_loader' => new FactoryTourChoiceLoader(),
                'expanded' => true,
                'multiple' => false,
                'label' => false))
            ->getForm()
        ;

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            $factoryTour = $form->getData();
                
            try {
            
                $fm->createAttendance($user, $factoryTour);
                
                $url = $this->generateUrl('member_factorytour_show', array('id' => $user->getId()));
                $this->log('Selected factory tour', Logger::INFO, $url);
                
                return $this->redirectToRoute('member_attendance_show',array('id' => $user->getId()));

            } catch (\Exception $e) {
                $this->log($e->getMessage(), Logger::ERROR);
                $factoryTour = $fm->updateNumbersOfRegisters($factoryTour);
            }
        }

        return $this->render('factorytour/new.html.twig', array(
            'form' => $form->createView(),
            'factoryTour' => $factoryTour,
        ));
    }
}
