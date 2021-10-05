<?php

namespace App\Controller;

use App\Entity\Users;
use App\Repository\UsersRepository;
use Doctrine\Persistence\ObjectManager;
use phppharser\Node\Expr\Cast\Object_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UsersController extends AbstractController
{
    /**
     * @Route("/users", name="users")
     */
    public function index(): Response
    {
        return $this->render('users/index.html.twig', [
            'controller_name' => 'UsersController',
        ]);
    }
    /**
     * @Route("/Profil", name="Profil")
     */
    public function Profil(Request $request)
    {
        $manager = $this->GetDoctrine()->getManager();

        $user = new Users();

        $form = $this->createFormBuilder($user)
            ->add('lastname', TextType::class, [
                'attr' => [
                    'placeholder' => 'Nom'
                ]
            ])
            ->add('Firstname', TextType::class, [

                'attr' => [
                    'placeholder' => 'prénom'
                ]
            ])

            ->add('email', TextType::class, [

                'attr' => [
                    'placeholder' => 'email'
                ]
            ])
            ->add('Pseudo', TextType::class, [

                'attr' => [
                    'placeholder' => 'lastname.firstname'
                ]
            ])

            ->add('NumberPhone', TextType::class, [

                'attr' => [
                    'placeholder' => 'numéro de télephone'
                ]
            ])
            ->add('Function', TextType::class, [

                'attr' => [
                    'placeholder' => 'statut'
                ]
            ])

            ->add('SessionNumber', TextType::class, [

                'attr' => [
                    'placeholder' => 'le numero de session'
                ]
            ])


            ->add('trainingYear', TextType::class, [

                'attr' => [
                    'placeholder' => 'année Courante'
                ]
            ])

            ->add('Linkedin', TextType::class, [

                'attr' => [
                    'placeholder' => 'linkedin'
                ]
            ])


            ->add('twitter', TextType::class, [

                'attr' => [
                    'placeholder' => ' twitter'
                ]
            ])

            ->add('github', TextType::class, [

                'attr' => [
                    'placeholder' => ' github'
                ]
            ])




            ->getForm();

        $form->handleRequest($request);

        return $this->render('users/Profil.html.twig', [
            'formUser' => $form->createview()
        ]);
    }

    /**
     * @Route("/listes", name="users_listes")
     */
    public function listes( UsersRepository $repository)
    { 
        $users=$repository->findAll();
        return $this->render('users/listes.html.twig', [
            'users' => $users

        ]);
    }


   /**
     * @Route("/show/{pseudo}", name="users_show")
     */
    public function show( Users $users)
    { 
       
        return $this->render('users/show.html.twig', [
            'users' => $users,

        ]);
    }

}
