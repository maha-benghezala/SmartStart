<?php
/**
 * Created by PhpStorm.
 * User: Maha
 * Date: 12/04/2019
 * Time: 19:32
 */

namespace ProfilBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class uploadType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cv',FileType::class, array('attr' => array('class' => 'upload file'),'data_class' => null))
            ->add('save',SubmitType::class ,array('attr' => array('class' => 'form-control')));

    }
}