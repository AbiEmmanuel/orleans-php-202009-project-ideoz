<?php

namespace App\Form;

use App\Entity\Project;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre',
            ])
            ->add('presentation', CKEditorType::class, [
                'label' => 'Présentation',
            ])
            ->add('purpose', TextType::class, [
                'label' => 'Ambition',
            ])
            ->add('owner', null, [
                'label' => 'Porteur de projet',
                'choice_label' => 'name',
                'expanded' => false,
                'multiple' => false,
                'required' => true,
            ])
            ->add('competences', null, [
                'label' => 'Compétences',
                'choice_label' => 'name',
                'expanded' => true,
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
