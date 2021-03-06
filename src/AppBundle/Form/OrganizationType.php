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
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use AppBundle\Entity\Organization;
use AppBundle\Utils\ChoiceList\OrganizationChoiceLoader;

/**
 * Description of OrganizationType
 *
 * @author toconuts
 */
class OrganizationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('shortname', TextType::class, array(
                'label' => 'shortname (less than 25)'
            ))
            ->add('address1', TextType::class)
            ->add('address2', TextType::class)
            ->add('city', TextType::class)
            ->add('province', TextType::class)
            ->add('country', CountryType::class, array(
                'placeholder' => 'Choose your country'
            ))
            ->add('zip', TextType::class)
            ->add('tel', TextType::class)
            ->add('fax', TextType::class)
            ->add('email', EmailType::class)
            ->add('homepage', UrlType::class)
            ->add('blog', UrlType::class)
            ->add('type', ChoiceType::class, array(
                'choice_loader' => new OrganizationChoiceLoader(),
            ))
            ->add('about_me', TextareaType::class, array(
                'label' => 'About (less than 255)',
                'attr' => [
                    'rows' => '10',
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
            'data_class' => 'AppBundle\Entity\Organization',
        ));
    }
}
