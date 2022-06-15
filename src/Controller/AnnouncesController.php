<?php

namespace App\Controller;
<<<<<<< HEAD
use App\Form\EntityType;
use App\DataFixtures\Categorie;
=======


>>>>>>> 2713ecffcd072afa923f55ab44995d57456d5148
use App\Entity\Announces;
use App\Entity\AnnounceSearch;
use App\Form\AnnounceSearchType;
use App\Form\AnnouncesType;
use App\Repository\AnnouncesRepository;
use App\Repository\UsersRepository;
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
    public function list(Request $request,AnnouncesRepository $announcesRepository): Response
    {

<<<<<<< HEAD
        //creation du formulaire de la recherche d'annonces

        $search = new AnnounceSearch();
        $form = $this->createForm(AnnounceSearchType::class, $search);
        $form->handleRequest($request);
=======

>>>>>>> 2713ecffcd072afa923f55ab44995d57456d5148
        //on recupère les annonces dans la BDD

        //$announcesRepository = $this->getDoctrine()
        //  ->getRepository(users::class)->findAll();
        $repository = $this->getDoctrine()->getRepository(Announces::class);

        //Toutes les annonces dans un tableau


        //recuperer toutes les annonces

        $announces = $repository->findAll();

        //Le produit avec l'id

        $repository->find(1);


        return $this->render('announces/list.html.twig', [
            'announces' => $announces,
<<<<<<< HEAD
            'form' => $form->createView()
=======

>>>>>>> 2713ecffcd072afa923f55ab44995d57456d5148
        ]);
    }





    /**
     * 
<<<<<<< HEAD
     * @Route("/announce/create", name="create_announce", methods={"GET", "POST"})
=======
     * @Route("/announce/create", name="create_announce")
>>>>>>> 2713ecffcd072afa923f55ab44995d57456d5148
     * 
     */

    public function create(Request $request, SluggerInterface $slugger): Response
    {

        //on prepare une entité
<<<<<<< HEAD

        $announce = new Announces;

        //dump($announce);

        //creation de formulaire Bootstrap

        $form = $this->createForm(AnnouncesType::class, $announce);

        // le formulaire est créer dans le fichier announcesType.php qui se trouve dans le dossier Form




=======

        $announce = new Announces;

        //dump($announce);

        //creation de formulaire Bootstrap

        $form = $this->createForm(AnnouncesType::class, $announce);

        // le formulaire est créer dans le fichier announcesType.php qui se trouve dans le dossier Form




>>>>>>> 2713ecffcd072afa923f55ab44995d57456d5148
        //faire le lien entre le formulaire et les données de la requête

        $form->handleRequest($request);

        //on hydrate l'objet des données du formulaire

        //verifier si le formulaire est soumis et validé

        if ($form->isSubmitted() && $form->isValid()) {

            $slug = $slugger->slug($announce->getTitle())->lower();

            $announce->setSlug($slug);


            $announce->setCreatedAt(new \DateTimeImmutable());

            //recuperer l'utilisateur connecté
            $announce->setUser($this->getUser());

            //Insertion dans la BDD...Persister un objet avec Doctrine

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($announce); //mets de côté l'objet
            $manager->flush(); //INSERT

            //on va rediriger vers la liste des annonces

            return $this->redirectToRoute('announces');
        }



        return $this->render('announces/create.html.twig', [
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/announce/{slug}", name="announce_show")
     */

    public function announce(Announces $announce)
    {
<<<<<<< HEAD
=======
        

>>>>>>> 2713ecffcd072afa923f55ab44995d57456d5148
        return $this->render('announces/announce.html.twig', [
            'announce' => $announce,
        ]);
    }


<<<<<<< HEAD
    /**
     * @Route("/{id}/announce", name="announce_edit", methods={"GET","POST"})
=======

    /**
     * @Route("/announce/{id}/edit", name="announce_edit")
>>>>>>> 2713ecffcd072afa923f55ab44995d57456d5148
     */

    public function edit(Request $request, Announces $announce): Response
    {
        //l'utilisateur doit être connecté s'il ne l'ai pas on redirige

<<<<<<< HEAD
        
        $this->denyAccessUnlessGranted('edit', $announce);

        
=======

        $this->denyAccessUnlessGranted('edit', $announce);


>>>>>>> 2713ecffcd072afa923f55ab44995d57456d5148
        $form = $this->createForm(AnnouncesType::class, $announce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('announces', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('announces/edit.html.twig', [
            'announce' => $announce,
            'form' => $form,
        ]);
    }

<<<<<<< HEAD

=======
>>>>>>> 2713ecffcd072afa923f55ab44995d57456d5148
    /**
     * @Route("/{id}/delete", name="announce_delete", methods={"POST"})
     */
    public function delete(Request $request, Announces $announce): Response
    {
        
        $this->denyAccessUnlessGranted('delete', $announce);

        //if ($this->isCsrfTokenValid('delete' . $announce->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($announce);
            $entityManager->flush();
        //}

        return $this->redirectToRoute('announces', [], Response::HTTP_SEE_OTHER);
    }



<<<<<<< HEAD
    
}
=======
}

>>>>>>> 2713ecffcd072afa923f55ab44995d57456d5148
