<?php

namespace App\Controller;

use App\Entity\Announces;
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

       $form= $this->createFormBuilder($announce)

            ->add('title')
            ->add('description', TextareaType::class)
            ->add('categories', ChoiceType::class,[
                'choices'  => [
                    'Stage' => null,
                    'Alternance' => null,
                    'Emploi' => null
                ],])
            ->add('original_link')
            ->add('name_company')
            ->add('adress_company')
            ->add('adress_additional')
            ->add('zipcode')
            ->add('city')
            
            ->getForm()
            ;


            //faire le lien entre le formulaire et les données de la requête

            $form->handleRequest($request);

            //on hydrate l'objet des données du formulaire

            //verifier si le formulaire est soumis et validé
            
            if ($form->isSubmitted() && $form->isValid()){


           //on recupère les données du formulaire

               $data = $form->getData();

                $announce = new Announces;

                $announce->setTitle($data['title']);
                $announce->setDescription($data['description']);
                $announce->setOriginalLink($data['original_link']);
                $announce->setNameCompany($data['description']);

                $manager = $this->getDoctrine()->getManager();
                $manager->persist($announce);
                $manager->flush();

                return $this->redirectToRoute('');
            }
            

            
        return $this->render('announces/create.html.twig', [
            'form' => $form ->createView() 
        ]);
     }



}
