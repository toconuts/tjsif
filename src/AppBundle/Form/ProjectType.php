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
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Entity\Project;
use AppBundle\Utils\ChoiceList\Topic;

/**
 * Description of ProjectType
 *
 * @author toconuts
 */
class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('concept', TextareaType::class)
            ->add('objective', TextareaType::class)
            ->add('topic', ChoiceType::class, array(
                'choice_loader' => new Topic()
            ))
            ->add('organization', EntityType::class, array(
                'class' => 'AppBundle:Organization',
                'disabled' => true,
                'choice_label' => 'name',
            ))
//TODO: add and delete students and teachers
            ->add('users', CollectionType::class, array(
                'entry_type' => UserType::class,
                'allow_add'     => true,
                'allow_delete'  => true,
                'prototype' => true,
                'prototype_name' => '__EntityId__',
                'entry_options'  => ['required'  => false],
                ))
            //    'by_reference'  => false,
             //   'prototype_data' => 'select user',
            //))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Project',
        ));
    }
}
