<?php

namespace App\Form;

use App\Entity\Project;
use App\Repository\CompetenceRepository;
use App\Repository\EcosystemRepository;
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
                    'query_builder' => function (EcosystemRepository $er) {
                        return $er->createQueryBuilder('e')
                        ->orderBy('e.name', 'ASC');
                    }
            ])
            ->add('competences', null, [
                'label' => 'Compétences',
                'choice_label' => 'name',
                'expanded' => true,
                'multiple' => true,
                'query_builder' => function (CompetenceRepository $cr) {
                    return $cr->createQueryBuilder('c')
                        ->orderBy('c.name', 'ASC');
                }
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
