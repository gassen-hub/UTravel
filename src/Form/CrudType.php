<?php

namespace App\Form;

use App\Entity\Endroit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Form\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType as TypeSubmitType;

class CrudType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom_endroit')
            
            ->add('adresse')
            ->add('disponibilite')
            ->add('horaire')
            ->add('prix')
            ->add('latitude')
            ->add('longitude')
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Endroit::class,
        ]);
    }
}
