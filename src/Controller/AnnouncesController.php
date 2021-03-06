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
    public function list(Request $request): Response
    {

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
        ]);
    }





    /**
     * 
     * @Route("/announce/create", name="create_announce")
     * 
     */

    public function create(Request $request, SluggerInterface $slugger): Response
    {

        //on prepare une entité

        $announce = new Announces();

        //dump($announce);

        //creation de formulaire Bootstrap

        $form = $this->createForm(AnnouncesType::class, $announce);

        // le formulaire est créer dans le fichier announcesType.php qui se trouve dans le dossier Form






        $announce = new Announces;

        //dump($announce);

        //creation de formulaire Bootstrap

        $form = $this->createForm(AnnouncesType::class, $announce);

        // le formulaire est créer dans le fichier announcesType.php qui se trouve dans le dossier Form






        //faire le lien entre le formulaire et les données de la requête

        $form->handleRequest($request);

       $form= $this->createForm(AnnouncesType::class, $announce);

            
            
            


        //on hydrate l'objet des données du formulaire

        //verifier si le formulaire est soumis et validé

        if ($form->isSubmitted() && $form->isValid()) {

            $slug = $slugger->slug($announce->getTitle())->lower();

            $announce->setSlug($slug);


            $announce->setCreatedAt(new \DateTimeImmutable());

               //$data = $form->getData();

               //Insertion dans la BDD...Persister un objet avec Doctrine

               $manager = $this->getDoctrine()->getManager();
                $manager->persist($announce);
                $manager->flush();

                
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
        

        return $this->render('announces/announce.html.twig', [
            'announce' => $announce,
        ]);
    }



    /**
     * @Route("/announce/{id}/edit", name="announce_edit")
     */

    public function edit(Request $request, Announces $announce): Response
    {
        //l'utilisateur doit être connecté s'il ne l'ai pas on redirige


        $this->denyAccessUnlessGranted('edit', $announce);


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



}

