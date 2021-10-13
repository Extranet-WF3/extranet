<?php

namespace App\Controller;
use App\Entity\Images;
use App\Entity\Users;
use App\Entity\Announces;
use App\Entity\Articles;
use App\Form\ImageType;
use App\Repository\AnnouncesRepository;
use App\Repository\ArticlesRepository;
use App\Repository\UsersRepository;
use Doctrine\Persistence\ObjectManager;
use phppharser\Node\Expr\Cast\Object_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Service\MailerService;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Vich\UploaderBundle\Form\Type\VichImageType;

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
     * @Route("Profil/edit", name="editProfil")
     */
    public function editProfil(Request $request)
    {
        $manager = $this->GetDoctrine()->getManager();

        $user = $this->getUser();

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

            ->add('image', ImageType::class, [
                'attr' => [

                    'placeholder' => 'Image'

                ]

            ])



            ->getForm();

        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()){
            $image = $form->get('image')->getData();
            $manager->persist($user);
            $manager->flush();
        }

        return $this->render('users/editProfil.html.twig', [
            'user' => $user,
            'formUser' => $form->createview(),

        ]);
    }

    /**
     * @Route("/listes", name="users_listes")
     */
    public function listes(UsersRepository $repository)
    {
        $users = $repository->findAll();
        return $this->render('users/listes.html.twig', [
            'users' => $users,

        ]);
    }


    /**
     * @Route("/show/{pseudo}", name="users_show")
     */
    public function show(Users $users)
    {

        return $this->render('users/show.html.twig', [
            'users' => $users,

        ]);
    }
    /**
     * @Route("/Profil", name="users_Profil")
     */
    public function Profil(ArticlesRepository $repoart, AnnouncesRepository $repoannoun)
    {
        $user = $this->getUser();





        $articles = $repoart->findByUser([$user], ['createdAt' => 'ASC'], 6, null);
        $announces = $repoannoun->findByUser([$user], ['createdAt' => 'ASC'], 6, null);
        return $this->render('users/Profil.html.twig', [
            'user' => $user,
            'articles' => $articles,
            'announces' => $announces,

        ]);
    }

    /**
     * @Route("/Profil/delete", name="deleteProfil")
     */
    public function delete()
    {

        $manager = $this->getDoctrine()->getManager();
        $manager->remove($this->getUser());
        $manager->flush();
        $session = $this->get('session');
        $session = new Session();
        $session->invalidate();

        return $this->redirectToRoute('app_logout');
    }

    /**
     * @Route("/admin", name="admin")
     */
    public function admin(UsersRepository $repository)
    {
        $users = $repository->findByActivated(0);
        return $this->render('users/Admin.html.twig', [
            'users' => $users,
        ]);
    }

    /**
     * @Route("admin/{id}/activer", name="admin_activated", methods="GET")
     */
    public function permuteActivated(UsersRepository $repository,MailerInterface $mailer ,$id)
    {
        $user = $repository->findOneBy(["id" => $id]);
        $user->setActivated(true);
        $entityManager = $this->getDoctrine()->getManager();
        $email = (new Email())
        ->from('webforc3@gmail.com')
        ->cc('webforc3@gmail.com')
        ->to($user->getEmail())
        ->subject('Compte WebForce3 ')
        ->text('L\'activation de votre compte a été validé par un administrateur.');
        $mailer->send($email);
        $entityManager->persist($user);
        $entityManager->flush();

        return $this->redirectToRoute('users_Profil');
    }
}
