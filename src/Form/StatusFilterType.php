<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StatusFilterType extends AbstractType
{
    private const STATUSES = [
        'Client' => 'Client',
        'Partenaire' => 'Partenaire',
        'Adhérent' => 'Adhérent',
        'Extérieur' => 'Extérieur',
    ];

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('status', ChoiceType::class, [
                'label' => 'Statut',
                'choices' => self::STATUSES,
                'expanded' => true,
                'multiple' => false,
                'required'   => false,
                'empty_data' => 'none',
                'placeholder' => 'Tous',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
