<?php

namespace App\Controller;

use App\Entity\Messages;
use App\Form\MessageType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MessagePrivateController extends AbstractController
{
    /**
     * @Route("/messageprivate", name="message_private")
     */
    public function index(Request $request): Response
    {
            // Je prépare l'entité 
        $messages = new Messages();
        

        // je crée un formulaire symfony 
        $form = $this->createForm(MessageType::class, $messages);

        $form->handleRequest($request);

        // si le formulaire a été soumis 

        if($form->isSubmitted()){

            // on enregistre le champ en bdd 
            $em = $this->getDoctrine()->getManager();
            $em->persist($messages);
            $em->flush(); // Insert 
            


            
           // Permet d'etre redigere dans la meme page avec la validation du message envoyé 
            $this->addFlash('success', 'Message Envoyé');
        }
        
        return $this->render('message_private/index.html.twig', [
            'controller_name' => 'MessagePrivateController'

           
        ]);
    }
   
   


}
