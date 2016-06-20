<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class BbsCommentType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('content', TextareaType::class, array(
                'label' => 'Write a comment...',
                'attr' => [
                    'rows' => '5',
                ]
            ))
            ->add('file', FileType::class, array(
                'label' => false,
                'required' => false,
                'attr' => [
                    'class' => 'btn btn-lg btn-success',
                    'title' => 'Add file',
                    'data-filename-placement' => "inside",
                ]
            ))
            ->add('imageFile', FileType::class, array(
                'label' => false,
                'required' => false,
                'attr' => [
                    'class' => 'btn btn-lg btn-success',
                    'title' => 'Add image',
                    'data-filename-placement' => "inside",
                ]
            ))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\BbsComment'
        ));
    }
}
