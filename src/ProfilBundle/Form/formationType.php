<?php

namespace ProfilBundle\Form;



use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class formationType extends AbstractType
{
/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ProfilBundle\Entity\formation'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'profilbundle_formation';
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomecole',TextType::class, array('attr' => array('class' => 'form-control')))

            ->add('diplome',TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('anneediplome', DateTimeType::class, array('attr' => array('class' => 'form-control')))
            ->add('domaine',TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('description',TextareaType::class, array('attr' => array('class' => 'form-control')))

            ->add('Ajouter', SubmitType::class, array('attr' => array('class' => 'form-control btn btn-primary pull-right')));
    }


}
