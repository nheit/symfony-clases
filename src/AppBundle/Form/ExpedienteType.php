<?php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;


class ExpedienteType extends AbstractType{
     public function buildForm(FormBuilderInterface $builder, array $options){
          $builder
            ->add('numero', TextType::class)
            ->add('anio', TextType::class)
            ->add('caratula', TextType::class)
        ;
     }
}
