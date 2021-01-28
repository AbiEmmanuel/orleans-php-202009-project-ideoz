<?php

namespace App\Form;

use App\Entity\Testimony;
use App\Repository\EcosystemRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TestimonyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('ecosystem', null, [
                'choice_label' => 'name',
                'label' => 'Membre de l\'écosystème',
                'query_builder' => function (EcosystemRepository $er) {
                    return $er->createQueryBuilder('e')
                    ->orderBy('e.name', 'ASC');
                }
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Témoignage'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Testimony::class,
        ]);
    }
}
