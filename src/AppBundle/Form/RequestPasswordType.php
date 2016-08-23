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
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Validator\Constraints\IsTrue;

/**
 * Description of RequestPasswordType
 *
 * @author toconuts
 */
class RequestPasswordType extends AbstractType
{ 
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, array(
                'label_attr' => array('class' => 'sr-only'),
                'attr' => [
                    'placeholder' => 'Email address',
                ]
            ))
            ->add('termsAccepted', CheckboxType::class, array(
                'label' => 'ARE YOU SURE YOU WANT TO RESET THE PASSWORD?',
                'mapped' => false,
                'constraints' => new IsTrue(),
            ))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Form\Model\RequestResettingPassword',
        ));
    }
}
