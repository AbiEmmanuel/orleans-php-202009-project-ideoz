<?php

namespace App\Form;

use App\Entity\Competence;
use App\Entity\Ecosystem;
use App\Entity\EcosystemSearch;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EcosystemSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('input', SearchType::class, [
                'label' => 'Nom de l\'entreprise ',
                'attr' => ['placeholder' => 'Rechercher...'],
                'required' => false,
            ])
            ->add('competences', EntityType::class, [
                'class' => Competence::class,
                'label' => 'Compétences',
                'required' => false,
                'choice_label' => 'name',
                'attr' => ['class' => 'competence row  justify-content-xs-center px-3 text-primary'],
                'expanded' => true,
                'multiple' => true,

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => EcosystemSearch::class,

        ]);
    }
}
