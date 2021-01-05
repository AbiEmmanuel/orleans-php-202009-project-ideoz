<?php

namespace App\Form;

use App\Entity\Ecosystem;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EcosystemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
            'label' => 'Nom',
            ])
            ->add('logo', TextType::class)
            ->add('activity', TextType::class, [
                'label' => 'Activité',
            ])
            ->add('particularity', TextType::class, [
                'label' => 'Compétence différenciante',
            ])
            ->add('url', TextType::class, [
                'label' => 'Site internet',
            ])
            ->add('abstract', TextType::class, [
                'label' => 'Résumé',
            ])
            ->add('status', null, [
                'choice_label' => 'name',
                'expanded' => true,
                'multiple' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ecosystem::class,
        ]);
    }
}
