<?php

namespace App\Controller;

use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\CategoryRepository;
use App\Repository\UserRepository;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Category;
use App\Entity\Comment;
use App\Service\ArticleService;
use Symfony\Component\HttpFoundation\JsonResponse;


class HomeController extends AbstractController
{
    private $userRepository;
    private $manager;
    //variable nombre de card article a affiche
    private int $nbArticle = 8;

    public function __construct(UserRepository $UserRepository, ManagerRegistry $manager)
    {
        $this->userRepository = $UserRepository;
        $this->manager = $manager;
    }

    #[Route('/', name: 'app_home')]
    public function index(ManagerRegistry $managerRegistry, ArticleService $articleService): Response
    {
        $CatogoryRepository = $managerRegistry->getRepository(Category::class);


        $articleRepository = $managerRegistry->getRepository(Article::class);
        $articles = $articleRepository->findAll();
        // Récupérer l'utilisateur actuellement authentifié
        $user = $this->getUser();
        // Vérifier si un utilisateur est authentifié


        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            // 'articles' =>   $articles,
            'articles' =>   $articleService->getLastNArticles($this->nbArticle),
            'home_page' => 'active'
        ]);
    }
    #[Route('show/{id}', name: 'app_show_v2')]
    public function show($id): Response
    {
        $repo = $this->manager->getRepository(Article::class);
        $article = $repo->find($id);
        return $this->render('show/index.html.twig', [
            'controller_name' => 'HomeController',
            'article' =>   $article,
        ]);
    }
    #[Route('/categories', name: 'app_categories')]
    public function getCategory(CategoryRepository $categoryRepository)
    {
        $categories = $categoryRepository->findAll();
        // Récupérer l'utilisateur actuellement authentifié
        $user = $this->getUser();
        $username = $user->getUsername();

        return $this->render('home/index.html.twig', [
            'categories' => $categories,
            'username' => $username,
        ]);
    }
    #[Route('/users', name: 'app_users')]
    public function getUsers()
    {
        $users = $this->userRepository->findAll();
        // Créez un tableau pour stocker les données des utilisateurs
        $userData = [];

        // Bouclez à travers chaque utilisateur pour récupérer les données souhaitées
        foreach ($users as $user) {
            $userData[] = [
                'id' => $user->getId(),
                'username' => $user->getUsername(),
                'email' => $user->getEmail(),
                'firstname' => $user->getFirstname(),
                'lastname' => $user->getLastname(),
                // Ajoutez d'autres champs si nécessaire
            ];
        }

        // Retournez les données des utilisateurs sous forme de réponse JSON
        return new JsonResponse($userData);
    }

    #[Route('/comments', name: 'app_comments')]
    public function getComments(ManagerRegistry $manager)
    {
        $CommentRepository = $manager->getRepository(Comment::class);
        $comments = $CommentRepository->findAll();
        $commentsJson = [];
        foreach ($comments as $comment) {
            $commentsJson[] = [
                'id' => $comment->getID(),
                'name' => $comment->getName(),
                'Content' => $comment->getContent()
            ];
        }
        return new JsonResponse($commentsJson);
    }
}
