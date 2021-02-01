<?php

namespace App\Form;

use App\Entity\Ecosystem;
use App\Repository\CompetenceRepository;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class EcosystemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom',
                'attr' => ['placeholder' => 'Duval SARL']
            ])
            ->add('phoneNumber', TelType::class, [
                'label' => 'Téléphone (optionnel)',
                'required' => false,
                'attr' => ['placeholder' => '06 12 34 56 78'],
            ])
            ->add('email', EmailType::class, [
                'label' => 'Adresse email',
                'attr' => ['placeholder' => 'adresse@email.fr'],
            ])
            ->add('url', TextType::class, [
                'label' => 'Site internet (optionnel)',
                'required' => false,
                'attr' => ['placeholder' => 'duval-sarl.fr'],
            ])
            ->add('logoFile', VichImageType::class, [
                'label' => 'Logo (optionnel)',
                'required' => false,
                'download_uri' => false,
            ])
            ->add('activity', TextType::class, [
                'label' => 'Secteur d\'activité (optionnel)',
                'required' => false,
            ])
            ->add('competences', null, [
                'label' => 'Compétences',
                'choice_label' => 'name',
                'attr' => ['class' => 'competences py-3'],
                'expanded' => true,
                'multiple' => true,
                'query_builder' => function (CompetenceRepository $cr) {
                    return $cr->createQueryBuilder('c')
                        ->orderBy('c.name', 'ASC');
                }
            ])
            ->add('abstract', TextType::class, [
                'label' => 'Présentation rapide (optionnel)',
                'help' => 'Description rapide présente dans la partie écosystème de la page d\'accueil',
                'required' => false,
            ])
            ->add('presentation', CKEditorType::class, [
                'label' => 'Présentation (optionnel)',
                'help' => 'Description complète présente sur les fiches individuelles',
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
