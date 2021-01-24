<?php

namespace App\Form;

use App\Entity\Ecosystem;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class MembershipType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom',
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
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
            ->add('url', UrlType::class, [
                'label' => 'Site internet',
                'required' => false,
            ])
            ->add('phoneNumber', TelType::class, [
                'label' => 'Numéro de téléphone',
                'required' => false,
            ])
            ->add('abstract', TextType::class, [
                'label' => 'Présentation rapide',
                'required' => false,
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
