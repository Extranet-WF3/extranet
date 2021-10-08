<?php

namespace App\Controller;
use App\Entity\Messages;
use App\Repository\UsersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MessageReceveidController extends AbstractController
{
    /**
     * @Route("/messagereceveid", name="message_receveid")
     */
    public function index(): Response
    {

        // récupere tous les donées msg private (objet : message)

        $receveid = $this->getDoctrine()
                   ->getRepository(Messages::class)// recuperer le messagesreposittoy.php
                   ->findAll();

              


        return $this->render('message_receveid/index.html.twig', [ // renvoi sur la page twig
            'messagereceveid' => 'MessageReceveidController',
        ]);
    }
}
