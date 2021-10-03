<?php

namespace App\Controller;

use App\Entity\Announces;
use App\Form\AnnouncesType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AnnouncesController extends AbstractController
{
    /**
     * @Route("/announces", name="announces")
     */
    public function index(): Response
    {
        return $this->render('announces/list.html.twig', [
            'controller_name' => 'AnnouncesController',
        ]);
    }
    /**
     * @Route("/announce", name="announce")
     */

     public function announce() {
        return $this->render('announces/announce.html.twig', [
            'controller_name' => 'AnnouncesController',
        ]);
     }


     /**
      * 
     * @Route("/announce/create", name="create_announce", methods={"GET", "POST"})
     * 
     */

    public function create(Request $request):Response{

    //on prepare une entité

    $announce= new Announces;
    dump($announce);

    //creation de formulaire Bootstrap

       $form= $this->createForm(AnnouncesType::class, $announce);

            
            
            


            //faire le lien entre le formulaire et les données de la requête

            $form->handleRequest($request);

            //on hydrate l'objet des données du formulaire

            //verifier si le formulaire est soumis et validé
            
            if ($form->isSubmitted() && $form->isValid()){


           //on recupère les données du formulaire

               //$data = $form->getData();

               //Insertion dans la BDD...Persister un objet avec Doctrine

               $manager = $this->getDoctrine()->getManager();
                $manager->persist($announce);
                $manager->flush();

                
            }
            

            
        return $this->render('announces/create.html.twig', [
            'form' => $form ->createView() 
        ]);
     }



}
