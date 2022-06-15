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
use Symfony\Component\Validator\Constraints\NotBlank;

class AnnouncesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
<<<<<<< HEAD
            ->add('category',  EntityType::class,[
                'class' => Categorie::class,
                'choice_label' => 'name',
                'multiple' =>true,
            ])
            
            ->add('title', null,[
                'label' => 'Announce',
                'attr' =>[
=======
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
>>>>>>> 2713ecffcd072afa923f55ab44995d57456d5148
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
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Announces::class,
        ]);
    }
}
