<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class BbsPostType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class)
            ->add('content', TextareaType::class, array(
                'attr' => [
                    'rows' => '5',
                ]
            ))
            ->add('tags', TextareaType::class, array(
                'required' => false,
                'attr' => [
                    'rows' => '1',
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
            'data_class' => 'AppBundle\Entity\BbsPost'
        ));
    }
}
