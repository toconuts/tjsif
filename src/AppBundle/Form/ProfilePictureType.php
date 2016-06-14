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
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Form\ImageStringToFileTransformer;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

/**
 * Description of ProfilePictureType
 *
 * @author toconuts <toconuts@gmail.com>
 */
class ProfilePictureType extends AbstractType
{
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder                
            ->add('imageFile', HiddenType::class, [
                'attr' => [
                    'class' => 'hidden-image-data'
                ]
            ])
            ->add('imagedata', FileType::class, [
                'mapped' => false,
                'required' => false,
                'attr' => [
                    'class' => 'cropit-image-input'
                ]
            ])
        ;

        $builder->get('imageFile')
            ->addModelTransformer(new ImageStringToFileTransformer($this->manager));
    }
}
