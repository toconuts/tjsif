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
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Entity\User;
use AppBundle\Utils\ChoiceList\GenderChoiceLoader;
use AppBundle\Utils\ChoiceList\TitleChoiceLoader;
use AppBundle\Utils\ChoiceList\AccountChoiceLoader;
use AppBundle\Utils\ChoiceList\OccupationChoiceLoader;

/**
 * Description of RegistrationType
 *
 * @author toconuts <toconuts@gmail.com>
 */
class RegistrationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', ChoiceType::class, array(
                'choice_loader' => new TitleChoiceLoader(),
                'placeholder' => 'Choose your title',
                'label' => 'Title *',
            ))
            ->add('firstname', TextType::class, array(
                'label' => 'Firstname *',
            ))
            ->add('middlename', TextType::class)
            ->add('lastname', TextType::class, array(
                'label' => 'Lastname *',
            ))
            ->add('nickname', TextType::class)
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options'  => array('label' => 'Password *'),
                'second_options' => array('label' => 'Repeat Password *'),
            ))
            ->add('gender', ChoiceType::class, array(
                'choice_loader' => new GenderChoiceLoader(),
                'expanded' => true,
            ))
            ->add('email', EmailType::class, array(
                'label' => 'Email *',
            ))
            ->add('tel', TextType::class)
            ->add('address1', TextType::class)
            ->add('address2', TextType::class)
            ->add('city', TextType::class)
            ->add('province', TextType::class)
            ->add('country', CountryType::class, array(
                'placeholder' => 'Choose your ocuntry',
                'label' => 'Country *',
            ))
            ->add('zip', TextType::class)
            ->add('homepage', UrlType::class)
            ->add('blog', UrlType::class)
            ->add('allergies', TextareaType::class)
            ->add('type', ChoiceType::class, array(
                'choice_loader' => new AccountChoiceLoader(),
                'placeholder' => 'Choose your account type. Student and ICT Teachers are should be Participant',
                'label' => 'Account type *',
            ))
            ->add('occupation', ChoiceType::class, array(
                'choice_loader' => new OccupationChoiceLoader(),
                'expanded' => false,
                'placeholder' => 'Choose your occupation',
                'label' => 'Occupation *',
            ))
            ->add('organization', EntityType::class, array(
                'class' => 'AppBundle:Organization',
                'choice_label' => 'name',
                'placeholder' => 'Choose your organization',
                'label' => 'Organization *',
            ))
            ->add('position', TextType::class)
            ->add('about_me', TextareaType::class, array(
                'label' => 'About me (less than 255)',
                'attr' => [
                    'rows' => '5',
                ]
            ))
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
