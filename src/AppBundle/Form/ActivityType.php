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
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use AppBundle\Utils\ChoiceList\OccupationChoiceLoader;

/**
 * Description of ActivityType
 *
 * @author toconuts <toconuts@gmail.com>
 */
class ActivityType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array(
                'label' => 'Event name *',
            ))
            ->add('venue', TextType::class)
            ->add('starttime', DateTimeType::class, array(
                'label' => 'Start date and time *',
                'input'  => 'datetime',
                'widget' => 'choice',
            ))
            ->add('endtime', TimeType::class, array(
                'label' => 'End time *'
            ))
            ->add('description', TextareaType::class, array(
                'attr' => [
                    'rows' => '5',
                ]
            ))
            ->add('targets', ChoiceType::class, array(
                'choice_loader' => new OccupationChoiceLoader(),
                'multiple' => true,
                'expanded' => true,
            ))
            ->add('isConfirm', ChoiceType::class, array(
                'choices'  => array(
                    'Yes' => true,
                    'No' => false,
                ),
                'label' => 'Confirmation required',
            ))
            ->add('isOfficial', ChoiceType::class, array(
                'choices'  => array(
                    'Yes' => true,
                    'No' => false,     
                ),
                'disabled' => $options['official_disabled'],
                'label' => 'TJ-SIF Official',
            ))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Activity',
            'official_disabled' => true,
        ));
    }
}
