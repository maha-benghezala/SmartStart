<?php

namespace ProfilBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExperienceType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('intituleposte',TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('nomentreprise',TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('lieu',TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('moisdebut',DateTimeType::class, array('attr' => array('class' => 'form-control')))
            ->add('moisfin',DateTimeType::class, array('attr' => array('class' => 'form-control')))
            ->add('anneedebut',DateTimeType::class, array('attr' => array('class' => 'form-control')))
            ->add('anneefin',DateTimeType::class, array('attr' => array('class' => 'form-control')))
            ->add('secteur',TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('description',TextareaType::class, array('attr' => array('class' => 'form-control')));

    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ProfilBundle\Entity\Experience'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'profilbundle_experience';
    }


}
