<?php

namespace App\Form;

use App\Entity\Messages;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\OptionsResolver\OptionsResolver;


class MessageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('target', TextType::class,[
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
