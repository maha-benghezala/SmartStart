<?php
/**
 * Created by PhpStorm.
 * User: Maha
 * Date: 17/03/2019
 * Time: 15:57
 */

namespace ProfilBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EntrepriseType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
  public function buildForm(FormBuilderInterface $builder, array $options)
{
    $builder
        ->add('nomSc',TextType::class, array('attr' => array('class' => 'form-control')))

        ->add('telephone',TextType::class, array('attr' => array('class' => 'form-control')))
        ->add('adresse',TextType::class, array('attr' => array('class' => 'form-control')))
        ->add('email',EmailType::class, array('attr' => array('class' => 'form-control')))
        ->add('image',fileType::class, array('attr' => array('class' => 'form-control')))
        ->add('specialite',TextType::class, array('attr' => array('class' => 'form-control')))

        ->add('ville',TextType::class, array('attr' => array('class' => 'form-control')))
        ->add('description',TextType::class, array('attr' => array('class' => 'form-control')))

        ->add('username',TextType::class, array('attr' => array('class' => 'form-control')))
        ->add('plainPassword', RepeatedType::class, array(
            'type' => PasswordType::class,
            'first_options' => array('label' => 'Mot de passe', 'attr' => array('class' => 'form-control')),
            'second_options' => array('label' => 'Répéter Mot de passe', 'attr' => array('class' => 'form-control')),
        ))
        ->add('Enregistrer', SubmitType::class, array('attr' => array('class' => 'form-control btn btn-primary pull-right')));
}/**
 * {@inheritdoc}
 */
    public function configureOptions(OptionsResolver $resolver)
{
    $resolver->setDefaults(array(
        'data_class' => 'ProfilBundle\Entity\User'
    ));
}

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
{
    return 'profilbundle_user';
}


}
