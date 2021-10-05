<?php

namespace App\Controller;

use App\Entity\Announces;
use App\Form\AnnouncesType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class AnnouncesController extends AbstractController
{
    /**
     * @Route("/announces", name="announces")
     */
    public function list(): Response
    {
        //on recupère les annonces dans la BDD

        $repository = $this->getDoctrine()->getRepository(Announces::class);

        //Toutes les annonces dans un tableau
        

        //recuperer toutes les annonces

        $announces = $repository->findAll();

        //Le produit avec l'id

        $repository->find(1);


        return $this->render('announces/list.html.twig', [
            'announces' => $announces,
        ]);
    }
    /**
     * @Route("/announce/{slug}", name="announce_show")
     */

     public function announce(Announces $announce) {
        return $this->render('announces/announce.html.twig', [
            'announce' => $announce,
        ]);
     }

     



     /**
      * 
     * @Route("/announce/create", name="create_announce", methods={"GET", "POST"})
     * 
     */

    public function create(Request $request, SluggerInterface $slugger):Response{

    //on prepare une entité

    $announce= new Announces;
    
    //dump($announce);

    //creation de formulaire Bootstrap

       $form= $this->createForm(AnnouncesType::class, $announce);

           // le formulaire est créer dans le fichier announcesType.php qui se trouve dans le dossier Form
            
            


            //faire le lien entre le formulaire et les données de la requête

            $form->handleRequest($request);

            //on hydrate l'objet des données du formulaire

            //verifier si le formulaire est soumis et validé
            
            if ($form->isSubmitted() && $form->isValid()){

                $slug = $slugger->slug($announce->getTitle())->lower();

                $announce->setSlug($slug);


                $announce->setCreatedAt(new \DateTimeImmutable());

               

               //Insertion dans la BDD...Persister un objet avec Doctrine

               $manager = $this->getDoctrine()->getManager();
                $manager->persist($announce); //mets de côté l'objet
                $manager->flush(); //INSERT

                //on va rediriger vers la même page

                return $this->redirectToRoute('create_announce');

                
            }
            

            
        return $this->render('announces/create.html.twig', [
            'form' => $form ->createView() 
        ]);
     }



}
