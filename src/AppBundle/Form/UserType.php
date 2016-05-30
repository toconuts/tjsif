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
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


/**
 * Description of UserType
 *
 * @author toconuts <toconuts@gmail.com>
 */
class UserType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, ['label' => 'Title*'])
            ->add('firstname', TextType::class, ['label' => 'Firstname*'])
            ->add('middlename', TextType::class)
            ->add('lastname', TextType::class, ['label' => 'Lastname*'])
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options'  => array('label' => 'Password*'),
                'second_options' => array('label' => 'Repeat Password*'),
                )        
            )
            ->add('email', EmailType::class, ['label' => 'Email*'])
        /*    ->add('gender', ChoiceType::class, array(
                'choices' => [
                    'Male',
                    'Female',
                ],
                'empty_data' => 0,
                'expanded' => true,
            ))*/
            ->add('tel', TextType::class)
            ->add('position', TextType::class)
            ->add('organization', EntityType::class, array(
                // query choices from this entity
                'class' => 'AppBundle:Organization',
                // use the User.username property as the visible option string
                'choice_label' => 'name',
            ))
            

     //       ->add('about_me', TextareaType::class, ['label' => 'About me (less than 255)'])
            ->add('termsAccepted', CheckboxType::class, array(
                'mapped' => false,
                'constraints' => new IsTrue(),
                )
            )
            ->add('register', SubmitType::class, [
                'label' => 'REGISTER!',
            ]);
    }
    
    /*
     * job
     * organization
     * type
     * position
     * city
     * province
     * country
     * zip
     * homepage
     * blog
     * allergies
     */

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\User',
        ));
    }
}
