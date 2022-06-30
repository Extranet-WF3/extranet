<?php

namespace App\Form;
use App\Form\EntityType;
use App\Entity\AnnounceSearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnnounceSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

        ->add('categorie',  EntityType::class,[
            'class' => Categorie::class,
            'choice_label' => 'name',
            'multiple' =>true,
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AnnounceSearch::class,
            'method'=> 'get',
            'crcf_protection' => false,
        ]);
    }
}
