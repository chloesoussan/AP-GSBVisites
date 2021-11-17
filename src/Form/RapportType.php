<?php

namespace App\Form;

use App\Entity\Medicament;
use App\Entity\Offrir;
use App\Entity\Rapport;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RapportType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date')
            ->add('motif')
            ->add('bilan')
            ->add('medecin')
            //->add('visiteur')

            ->add('offrirs', CollectionType::class, [
                'entry_type' => OffrirType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'by_reference' => false,
                'entry_options' => ['label' => false]
            ])
            ->add('motif', ChoiceType::class, [
                'choices' => [
                    'Demande du médecin' => 'Demande du médecin',
                    'Recommandation de confrère' => 'Recommandation de confrère',
                    'Prise de contact' => 'Prise de contact',
                    'Visite annuelle' => 'Visite annuelle',
                    'Installation nouvelle' => 'Installation nouvelle',
                    'Positif' => 'Positif'

                ]
            ])


        //->add('valider', SubmitType::class);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Rapport::class,
        ]);
    }
}
