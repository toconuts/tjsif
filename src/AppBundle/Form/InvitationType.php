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
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
//use Symfony\Component\Form\Extension\Core\Type\PasswordType;
//use Symfony\Component\Validator\Constraints\IsTrue;
//use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

/**
 * Description of InvitationType
 *
 * @author toconuts <toconuts@gmail.com>
 */
class InvitationType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class)
            ->add('email', RepeatedType::class, array(
                'type' => EmailType::class,
                'first_options'  => array('label' => 'Email'),
                'second_options' => array('label' => 'Repeat Email'),
                )        
            )
            ->add('submit', SubmitType::class, [
                'label' => 'Invite',
            ]);
        
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Invitation',
        ));
    }
}
