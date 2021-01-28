<?php

namespace App\Form;

use App\Entity\Offer;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class OfferType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom'
            ])
            ->add('catchPhrase', TextType::class, [
                'label' => 'Phrase d\'accroche',
                'help' => 'Texte présent en haut de la page, sous le titre'
            ])
            ->add('abstract', CKEditorType::class, [
                'label' => 'Résumé',
                'help' => 'Description rapide présente sur la page d\'accueil'
            ])
            ->add('description', CKEditorType::class, [
                'label' => 'Description du service'
            ])
            ->add('example', CKEditorType::class, [
                'label' => 'Exemple (optionnel)',
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Offer::class,
        ]);
    }
}
