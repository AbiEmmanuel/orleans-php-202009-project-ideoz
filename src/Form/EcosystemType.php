<?php

namespace App\Form;

use App\Entity\Ecosystem;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class EcosystemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
            'label' => 'Nom',
            ])
            ->add('logoFile', VichImageType::class, [
                'label' => 'Logo',
                'required' => false,
                'download_uri' => false,
            ])
            ->add('activity', TextType::class, [
                'label' => 'Secteur d\'activité',
                'required' => false,
            ])
            ->add('competence', null, [
                'label' => 'Compétence différenciante',
                'choice_label' => 'name',
                'expanded' => true,
                'multiple' => true,
            ])
            ->add('url', TextType::class, [
                'label' => 'Site internet',
                'required' => false,
            ])
            ->add('abstract', CKEditorType::class, [
                'label' => 'Présentation rapide',
                'required' => false,
            ])
            ->add('status', null, [
                'label' => 'Statut',
                'choice_label' => 'name',
                'expanded' => true,
                'multiple' => false,
                'required' => true,
            ])
            ->add('isValidated', ChoiceType::class, [
                'label' => 'Adhésion validée',
                'choices'  => [
                    'Oui' => true,
                    'Non' => false,
                ],
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
