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
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Utils\ChoiceList\Topic;

/**
 * Description of ProjectType
 *
 * @author toconuts <toconuts@gmail.com>
 */
class ProjectBaseType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('concept', TextareaType::class)
            ->add('objective', TextareaType::class)
            ->add('topic', ChoiceType::class, array(
                'choice_loader' => new Topic(),
                'placeholder' => 'Choose topic of project',
            ))
            ->add('organization', EntityType::class, array(
                'class' => 'AppBundle:Organization',
                'choice_label' => 'name',
                'placeholder' => 'Choose your school',
                'disabled' => $options['organization_disabled'],
            ))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Project',
            'organization_disabled' => true,
        ));
    }
}
