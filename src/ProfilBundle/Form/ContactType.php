<?php
/**
 * Created by PhpStorm.
 * User: Maha
 * Date: 16/04/2019
 * Time: 18:08
 */

namespace ProfilBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('email',TextType::class, array('attr' => array('class' => 'form-control')))
        ->add('message',TextareaType::class, array('attr' => array('class' => 'form-control')))
        ->add('envoyer', SubmitType::class, array('attr' => array('class' => 'btn btn-md button-theme')));
    }
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ProfilBundle\Entity\contact'
        ));
    }
}