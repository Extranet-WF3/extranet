<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\RegistrationFormType;
use App\Service\MailerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mime\Email;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/inscription", name="app_register")
     */
    public function registerForm(Request $request, UserPasswordHasherInterface $userPasswordHasherInterface, MailerInterface $mailer): Response
    { 
        
        $user = new Users();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);
        

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
            $userPasswordHasherInterface->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                
                )
            );
            $user->setCreatedAt(new \DateTime());
            $user->setUpdateAt(new \DateTime());
            $user->setPseudo($user->getlastname().$user->getfirstname());
            $user->setActivated(0);
            

        

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $email = (new Email())
                ->from('webforc3@gmail.com')
                ->cc('webforc3@gmail.com')
                ->to($user->getEmail())
                ->subject('Inscription à l\'Extranet de WebForce3')
                ->text('L\'activation de votre compte sera valider par un administrateur');
            $mailer->send($email);
            
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('app_login');
        }

        return $this->render('users/inscription.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
