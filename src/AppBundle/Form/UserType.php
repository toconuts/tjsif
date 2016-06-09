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
use AppBundle\Utils\ChoiceList\Gender;
use AppBundle\Utils\ChoiceList\Title;
use AppBundle\Utils\ChoiceList\AccountType;

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
            ->add('title', ChoiceType::class, array(
                'choice_loader' => new Title()
            ))
            ->add('firstname', TextType::class, array(
                'label' => 'Firstname*',
            ))
            ->add('middlename', TextType::class)
            ->add('lastname', TextType::class, array(
                'label' => 'Lastname*',
            ))
            ->add('gender', ChoiceType::class, array(
                'choice_loader' => new Gender(),
                'expanded' => true,
            ))
            ->add('email', EmailType::class, array(
                'disabled' => true,
                'label' => 'Email*',
            ))
            ->add('tel', TextType::class)
            ->add('address1', TextType::class)
            ->add('address2', TextType::class)
            ->add('city', TextType::class)
            ->add('province', TextType::class)
            ->add('country', CountryType::class, array(
            ))
            ->add('zip', TextType::class)
            ->add('homepage', UrlType::class)
            ->add('blog', UrlType::class)
            ->add('allergies', TextareaType::class)
            ->add('type', ChoiceType::class, array(
                'choice_loader' => new AccountType(),
            ))
            ->add('job', EntityType::class, array(
                'class' => 'AppBundle:Job',
                'disabled' => true,
                'choice_label' => 'name',
                'placeholder' => 'Choose your job',
            ))
            ->add('organization', EntityType::class, array(
                'class' => 'AppBundle:Organization',
                'disabled' => true,
                'choice_label' => 'name',
            ))
            ->add('position', TextType::class)
            ->add('about_me', TextareaType::class, array(
                'label' => 'About me (less than 255)',
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
        ));
    }
}
