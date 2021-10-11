<?php

namespace App\Controller;
use App\Entity\Messages;
use App\Entity\Users;
use App\Repository\MessagesRepository;
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
    public function index(MessagesRepository $repository ): Response
    {
        $user = $this->getUser();
       
        $messages = $repository->findByUser([$user], null, 1, null);

       // dd($receveid);

              
        return $this->render('message_receveid/receveid.html.twig', [ 
            'messages' => $messages, 
            'user' => $user, // permet d'envoyer ce qu'on a recuperer sur twig 
        ]);
    }
}
