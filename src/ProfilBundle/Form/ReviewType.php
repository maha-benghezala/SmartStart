<?php
/**
 * Created by PhpStorm.
 * User: Maha
 * Date: 15/04/2019
 * Time: 12:19
 */

namespace ProfilBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReviewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('avis',TextType::class, array('attr' => array('class' => 'form-control','style'=>'display : none')))
            ->add('commantaire',TextareaType::class, array('attr' => array('class' => 'form-control')))
            ->add('AjouterAvis',SubmitType::class, array('attr' => array('class' => 'form-control btn btn-primary')));
    }
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ProfilBundle\Entity\Rate'
        ));
    }


}