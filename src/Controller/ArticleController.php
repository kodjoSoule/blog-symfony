<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use App\Entity\Comment;
use App\Form\CommentFormType;
use App\Repository\ArticleRepository;
use App\Service\CommentService;

use Knp\Component\Pager\PaginatorInterface;




class ArticleController extends AbstractController
{
    private $paginator;
    private $articleRepository;
    public function __construct(PaginatorInterface $paginator, ArticleRepository $articleRepository)
    {
        $this->paginator = $paginator;
        $this->articleRepository = $articleRepository;
    }
    #[Route('/articles', name: 'app_articles')]
    public function index(
        ManagerRegistry $managerRegistry,
        CommentService $commentService,
        //PaginatorInterface $paginator
        Request $request
    ): Response {

        $articleRepository = $managerRegistry->getRepository(Article::class);

        $query = $articleRepository->createQueryBuilder('a')->getQuery();
        $pagination = $this->paginator->paginate(
            $query,
            $request->query->getInt('page', 1), // Récupère le numéro de page à partir de la requête
            10 // Nombre d'articles par page
        );



        $articles = $articleRepository->findAll();
        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
            'article_page' => 'active',

            'articles' =>   $articles,
            'comment_service' => $commentService,
            'pagination' => $pagination,
        ]);
    }
    #[Route('/article/{id}', name: 'app_show')]
    public function show($id, ManagerRegistry $managerRegistry, Request $request,  CommentService $commentService): Response
    {
        $articleRepo = $managerRegistry->getRepository(Article::class);
        $entityManager = $managerRegistry->getManager();
        $article = $articleRepo->find($id);

        $comment = new Comment();
        $comment->setArticle($article); // Associez le commentaire à l'article
        $comment->setUser($this->getUser());

        $commentForm = $this->createForm(CommentFormType::class);
        $commentForm->handleRequest($request);

        if ($commentForm->isSubmitted() && $commentForm->isValid()) {
            $commentContent = $commentForm->getData()->getContent();
            $comment->setContent($commentContent);
            //$entityManager->persist($comment);
            //$entityManager->flush();
            $commentService->createComment($comment);
            // Redirigez l'utilisateur vers la page de l'article après la soumission du commentaire
            return $this->redirectToRoute('app_show', ['id' => $article->getId()]);
        }

        // Affichez la page de l'article avec le formulaire de commentaire
        return $this->render('article/item.html.twig', [
            'article' => $article,
            'commentForm' => $commentForm,
            'comment_service' => $commentService,
            'article_page' => 'active',
        ]);
    }

    // #[Route('/article/{id}/comment', name: 'comment_article')]
    public function commentArticle(Request $request, Article $article, ManagerRegistry $manager): Response
    {
        $comment = new Comment();
        $comment->setArticle($article); // Associez le commentaire à l'article


        $commentForm = $this->createForm(CommentFormType::class);
        $commentForm->handleRequest($request);

        if ($commentForm->isSubmitted() && $commentForm->isValid()) {

            //$entityManager = $this->getDoctrine()->getManager();
            $entityManager = $manager->getManager();
            $entityManager->persist($comment);
            $entityManager->flush();

            // Redirigez l'utilisateur vers la page de l'article après la soumission du commentaire
            return $this->redirectToRoute('app_show', ['id' => $article->getId()]);
        }

        // Affichez la page de l'article avec le formulaire de commentaire
        return $this->render('article/item.html.twig', [
            'article' => $article,
            'testForm' => 'Test',
            'article_page' => 'active',
        ]);
    }

    #[Route('/search', name: 'app_search')]
    public function search(Request $request)
    {
        //$query = $request->query->get('q'); // Récupérer le terme de recherche depuis la requête GET

        // Effectuer la recherche dans la base de données en utilisant $query
        //$articles = $this->articleRepository->findBySearchQuery($query);

        $searchResults = [];

        return $this->render('article/search_results.html.twig', [
            // 'query' => $query,
            // 'articles' => $articles,
            'article_page' => 'active',
            'searchResults' => $searchResults,
        ]);
    }
}
