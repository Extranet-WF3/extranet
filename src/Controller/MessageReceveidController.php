<?php

namespace App\Controller;
use App\Entity\Messages;
use App\Entity\Users;
use App\Repository\UsersRepository;
use Doctrine\ORM\Mapping\Id;
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
        $receveids = $this->getDoctrine()
        ->getRepository(Messages::class)
        ->getRepository(Users::class)
        ->findAll();

       // dd($receveid);

              
        return $this->render('message_receveid/index.html.twig', [ // renvoi sur la page twig
            'receveids' => $receveids, // permet d'envoyer ce qu'on a recuperer sur twig 
        ]);
    }
}
