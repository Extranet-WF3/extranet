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
            ->add('category',  EntityType::class,[
                'class' => Categorie::class,
                'choice_label' => 'name',
                'multiple' =>true,
            ])
            
            ->add('title', null,[
                'label' => 'Announce',
                'attr' =>[
                    'placeholder' => 'veuillez entrer le titre de l\'annonce',
                ],
            ])

            
            ->add('description',null, [
                'label' => 'Description du poste'], TextareaType::class)
                
            ->add('originalLink',null,[
                'label' => 'Lien de l\'annonce'
                ])
            ->add('nameCompany',null,[
                'label' => 'Entreprise'
                ])
            ->add('adressCompany',null,[
                'label' => 'Adresse de l\'entreprise'
                ])
            ->add('adressAdditional',null,[
                'label' => 'L\' adresse additionnelle'
                ])
            ->add('zipCode',null,[
                'label' => 'Code postal'
                ])
            ->add('city',null,[
                'label' => 'Ville'
                ])
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
