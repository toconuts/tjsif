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

use Doctrine\ORM\EntityRepository;


/**
 * Description of ProjectType
 *
 * @author toconuts
 */
class ProjectType extends AbstractType
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
            ->add('users', EntityType::class, array(
                'class' => 'AppBundle:User',
                'choice_label' => 'fullnamewithJob',
                'multiple' => true,
                'expanded' => true,
                'label' => false,
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        //->where('User u, AppBundle:Job j, AppBundle:Organization o')
                        //->orderBy('o.id', 'ASC');
                        //->where('u.job = 1')
                        ->orderBy('u.organization', 'ASC');
                        //->add('orderBy', 's.sort_order ASC');
                },
            /*    'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.organization.id', 'ASC');
                },*/
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
