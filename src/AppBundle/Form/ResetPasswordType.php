<?php

/*
 * This file is part of the TJ-SIF 2016 project.
 *
 * (c) toconuts <toconuts@google.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

/**
 * Description of ResetPasswordType
 *
 * @author toconuts
 */
class ResetPasswordType extends AbstractType
{ 
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('userVerificationCode', TextType::class, array(
                'label_attr' => array('class' => 'sr-only'),
                'attr' => [
                    'placeholder' => 'Verification code',
                ]
            ))
            ->add('newPassword', RepeatedType::class, array(
            'type' => PasswordType::class,
            'invalid_message' => 'The password fields must match.',
            'required' => true,
            'label_attr' => array('class' => 'sr-only'),
            'first_options'  => array(
                'label_attr' => array('class' => 'sr-only'),
                'label' => 'Password',
                'attr' => [
                    'placeholder' => 'New password',
                ]
                
            ),
            'second_options' => array(
                'label_attr' => array('class' => 'sr-only'),
                'label' => 'Repeat Password',
                'attr' => [
                    'placeholder' => 'Repeat new password',
                ]
            ),
        ));
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\ResettingPassword',
        ));
    }
}
