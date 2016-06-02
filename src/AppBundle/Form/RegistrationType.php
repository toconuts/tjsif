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
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


/**
 * Description of RegistrationType
 *
 * @author toconuts <toconuts@gmail.com>
 */
class RegistrationType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', ChoiceType::class, array(
                'choices' => [
                    'Mr. '  => 1,
                    'Ms.'   => 2,
                    'Mrs.'  => 3,
                    'Miss.' => 4,
                    'Dr.'   => 5,
                ]
            ))
            ->add('firstname', TextType::class, ['label' => 'Firstname*'])
            ->add('middlename', TextType::class)
            ->add('lastname', TextType::class, ['label' => 'Lastname*'])
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options'  => array('label' => 'Password*'),
                'second_options' => array('label' => 'Repeat Password*'),
                )        
            )
            ->add('gender', ChoiceType::class, array(
                'choices' => [
                    'Not Specified' => 0,
                    'Male' => 1,
                    'Female' => 2,
                ],
                'expanded' => true,
            ))
            ->add('email', EmailType::class, ['label' => 'Email*'])
            ->add('tel', TextType::class)

            ->add('type', ChoiceType::class, array(
                'choices' => [
                    'Participant'  => 1,
                    'Observer'      => 2,
                ]
            ))
            ->add('job', EntityType::class, array(
                'class' => 'AppBundle:Job',
                'choice_label' => 'name',
            ))
            ->add('organization', EntityType::class, array(
                'class' => 'AppBundle:Organization',
                'choice_label' => 'name',
            ))
            ->add('position', TextType::class)
            ->add('city', TextType::class)
            ->add('province', TextType::class)
            ->add('country', ChoiceType::class, array(
                'choices' => [
                    'Thailand'  => 1,
                    'Japan'     => 2,
                    'The other' => 3,
                ]
            ))
            ->add('zip', TextType::class)

            ->add('homepage', UrlType::class)
            ->add('blog', UrlType::class)
            ->add('allergies', TextareaType::class)
            ->add('about_me', TextareaType::class, ['label' => 'About me (less than 255)'])
            ->add('termsAccepted', CheckboxType::class, array(
                'mapped' => false,
                'constraints' => new IsTrue(),
                )
            )
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\User',
            'validation_groups' => array('registration'),
        ));
        
        
    }
    
    
}
