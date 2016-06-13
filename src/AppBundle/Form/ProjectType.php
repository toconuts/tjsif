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

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
Use AppBundle\Form\ProjectBaseType;

/**
 * Description of ProjectType
 *
 * @author toconuts <toconuts@gmail.com>
 */
class ProjectType extends ProjectBaseType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder->add('users', EntityType::class, array(
            'class' => 'AppBundle:User',
            'choice_label' => 'fullnamewithJob',
            'multiple' => true,
            'expanded' => true,
            'label' => false,
            'query_builder' => function(EntityRepository $er) use ($options) {
                return $er->createQueryBuilder('u')
                    ->where('u.type = 1')
                    ->orderBy('u.organization', 'ASC');
            },
        ));
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
