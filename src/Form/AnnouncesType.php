<?php

namespace App\Form;

use App\Entity\Announces;
use App\Entity\Categorie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AnnouncesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('categories', ChoiceType::class, [
                'choices'  => [
                    'Stage' => 'Stage',
                    'Alternance' => 'Alternance',
                    'Emploi' => 'Emploi'
                ],
            ])

            ->add('title', null, [
                'label' => 'Titre de l\'annonce',
                'attr' => [
                    'placeholder' => 'veuillez entrer le titre de l\'annonce',
                ],
            ])


            ->add('description',TextareaType::class , [
                'label' => 'Description de l\'annonce',
                'attr' => [
                'placeholder' => 'Decrire le poste',
            ], ])

            ->add('originalLink', null, [
                'label' => 'Lien de l\'annonce',
                'attr' => [
                    'placeholder' => 'Lien de l\'annonce'
                ],])
            ->add('nameCompany', null, [
                'label' => 'Entreprise',
                'attr' => [
                    'placeholder' => 'Entreprise'
                ],])
            ->add('adressCompany', null, [
                'label' => 'Adresse de l\'entreprise',
                'attr' => [
                    'placeholder' => 'Adresse'
                ],])
            
            ->add('adressAdditional', null, [
                'label' => ' Adresse additionnelle',
                'attr' => [
                    'placeholder' => 'Adresse additionnelle'
                ],])
            
            ->add('zipCode', null, [
                'label' => 'Code postal',
                'attr' => [
                    'placeholder' => 'Code postal'
                ],])
            
            ->add('city', null, [
                'label' => 'Ville',
                'attr' => [
                    'placeholder' => 'Ville'
                ],])
            
            // ->add('user')
            // ->add('createdAt')

           
            ->add('categories', ChoiceType::class,[
                'choices'  => [
                    'Stage' => null,
                    'Alternance' => null,
                    'Emploi' => null
                ],])
            ->add('title')
            ->add('description', TextareaType::class)
            ->add('originalLink')
            ->add('nameCompany')
            ->add('adressCompany')
            ->add('adressAdditional')
            ->add('zipCode')
            ->add('city')
            ->add('user')
            ->add('createdAt')

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Announces::class,
        ]);
    }
}
