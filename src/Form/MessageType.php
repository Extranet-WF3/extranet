<?php

namespace App\Form;

use App\Entity\Messages;
use Doctrine\ORM\Mapping\Id;
use phpDocumentor\Reflection\Types\Null_;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\ChoiceList\Factory\Cache\ChoiceLabel;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\OptionsResolver\OptionsResolver;


class MessageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('target', Null,[
            'choice_label' => 'pseudo',
            'label' => 'Destinataire',
    
            ])
            ->add('Object', TextareaType::class,[
                'label' => 'Objet',
                'attr' => [
                    'placeholder' => 'Objet',
                ],
            ])
            ->add('Message', TextareaType::class,[
                'label' => 'Message',
            ]);
            
           // ->getForm();
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
    
        $resolver->setDefaults([
            'data_class' => Messages::class,
        ]);
    }
}
