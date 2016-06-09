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
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

/**
 * Description of ChoiceMemberType
 *
 * @author toconuts <toconuts@gmail.com>
 */
class ChoiceMemberType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('users', EntityType::class, array(
                'class'         => 'AppBundle:User',
                'label'         => 'Children',
                'choice_label'  => 'fullname',
                //'property'      => 'any_property_for_label',
                'expanded'      => true,
                'multiple'      => true
            ));
            /*->add('users', EntityType::class, array(
            //    ->add('users', \Symfony\Component\Form\Extension\Core\Type\CollectionType::class, array(
                //'class' => 'AppBundle:User',
                'class' => $options,
                'choice_label' => 'fullname',
                'multiple' => true,
                'expanded' => true,
            ))*/
            /*->add('student', ChoiceType::class, array(
                'choices' => $options,
                'multiple' => true,
                'expanded' => true,
                'choices_as_values' => true,
            ))*/
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            //users' => false,
            //'data_class' => 'AppBundle\Entity\User',
        ));
    }
    
}
