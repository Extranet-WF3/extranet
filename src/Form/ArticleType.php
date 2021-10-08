<?php

namespace App\Form;

use App\Entity\Articles;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

        // La donnée createdAt est générée automatiquement dans le contrôleur    
        // ->add('createdAt')

            ->add('title', null, [
                'label'=>'Titre',
                'attr'=>[
                    'autofocus' => true
                ],
                'attr'=>[
                    'placeholder' => 'Titre'
                ],
                ])

            ->add('categories', ChoiceType::class, [
                'label'=>'Catégorie',
                'attr'=>[
                    'autofocus' => true
                ],
                'attr'=>[
                    'placeholder' => 'Choisir la catégorie'
                ],
                'choices' => [
                    '' => null,
                    'Général' => 'Général',
                    'Programmation' => 'Programmation',
                    'Langage' => 'Langage',
                    'Framework' => 'Framework',
                    'API' => 'API',
                    'Logiciel' => 'Logiciel',
                    'Matériel informatique' => 'Matériel informatique',
                    'Secteur emploi' => 'Secteur emploi',
                ],
                ])

            ->add('description', null, [
                'label'=>'Description',
                'attr'=>['rows' => 10, 'cols' => 50 ],
                'attr'=>[
                    'placeholder' => 'Ecrire votre article'
                ],
                ])

            -> add('originalLink', null, [
                'label'=>'Lien de l\'article',
                'attr'=>[
                    'autofocus' => true
                ],
                'attr'=>[
                    'placeholder' => 'Déposer le lien de l\'article'
                ],
                ])

            // La donnée user_id est récupérée de la table Users    
            //->add('user')

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Articles::class,
        ]);
    }
}
