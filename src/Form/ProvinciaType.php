<?php

namespace App\Form;

use App\Entity\Provincia;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Ciudad;

class ProvinciaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ciudad',EntityType::class,array(

                'class' => Ciudad::class,

                'choice_label' => function ($ciudad) {

                    return $ciudad->getNombre();

            }))
            ->add('nombre')
            ->add('save', SubmitType::class, array(
             'attr' => array('class' => 'btn btn-success'),
         ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Provincia::class,
        ]);
    }
}
