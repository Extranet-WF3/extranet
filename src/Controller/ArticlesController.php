<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Form\ArticleType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class ArticlesController extends AbstractController
{

    /** Formulaire de création d'un article
     * @Route("/article/create", name="article_create")
     * @param article
     * @return Response
     * On utilise le service $slugger de l'interface SluggerInterface
     */
    public function create(Request $request, SluggerInterface $slugger): Response
    {
        // On prépare l'entité article
        $article = new Articles();

        // On crée le formulaire avec un Symfony
        $form = $this->createForm(ArticleType::class, $article);

        // On va faire le lien entre notre formulaire et les données de la requête
        $form->handleRequest($request);
        // A cette étape, le form de Symfony "hydrate" l'objet
        // C'est à dire qu'il remplit les données de l'objet avec les données du formulaire

        // On génère la date de création de l'article
        $article->setcreatedAt(new \DateTimeImmutable()); 


        // On vérifie si le formulaire est soumis si on est en Post et aussi valide (champ non vide et syntaxe valide)
        if ($form->isSubmitted() && $form->isValid()) {

            // Génération du slug et injection dans la BDD
            $slug = $slugger->slug($article->gettitle())->lower();
            $article->setSlug($slug);

            // Insérer en BDD... Persister un objet avec Doctrine
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($article); // Met de côté l'objet
            $manager->flush(); // INSERT

        // Confirmation par message "flash" de la création de l'article
        $this->addFlash(
            'success',
            'Votre article a été créé avec succès.'
        );

        // Redirection vers la page de liste des articles
        return $this->redirectToRoute('list_article');

        // ou
        // Redirection vers le nouveau produit /product/le-slug-du-produit
        // return $this->redirectToRoute('product_show', ['slug' => $product->getSlug()]);
        }

        return $this->render('articles/create.html.twig', [

            'form' => $form->createView(),
        ]);
    }



    /** Affichage de la liste des articles
     * @Route("/articles", name="list_article")
     * @param 
     * @return Response
     */
    public function index(): Response
    {


        return $this->render('articles/index.html.twig', [
            'controller_name' => 'ArticlesController',
        ]);
    }



    
    /** Affichage d'un article avec Param Converter
     * @Route("/article/{slug}", name="article_show")
     * @param Article
     * @return Response
     */
    public function show(Articles $Article): Response
    {
        return $this->render('articles/show.html.twig', [
            'article' => $Article,
            ]  
        );
    }
}


