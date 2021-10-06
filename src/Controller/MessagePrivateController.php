<?php

namespace App\Controller;

use App\Entity\Messages;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MessagePrivateController extends AbstractController
{
    /**
     * @Route("/messageprivate", name="message_private")
     */
    public function index(): Response
    {
            // Je prépare l'entité 
        $messages = new Messages();
        dump($messages);

        // je crée un formulaire symfony 
        $form = $this->createForm(ContactType::class, $messages)

        $manager = $this->getDoctrine()->getManager();
        $manager->persist($messages);
        $manager->flush()




        
        return $this->render('message_private/index.html.twig', [
            'messages' => $messages->createView(),

           
        ]);
    }
   
   


}
