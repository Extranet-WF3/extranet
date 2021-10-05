<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MessagePrivateController extends AbstractController
{
    /**
     * @Route("/messageprivate", name="message_private")
     */
    public function index(): Response
    {
        return $this->render('message_private/index.html.twig', [
            'controller_name' => 'MessagePrivateController',
        ]);
    }
}
