<?php

namespace App\Controller;

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
            // je crée un formulaire avec 
        $message = $this->createFormBuilder();
        
        return $this->render('message_private/index.html.twig', [
            'form' => '',
        ]);
    }
   
   


}
