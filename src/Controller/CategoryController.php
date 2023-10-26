<?php

namespace App\Controller;

use App\Entity\Category;
use App\Service\CategoryService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{

    private $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    #[Route('/category', name: 'app_category')]
    public function index(): Response
    {
        $categories = $this->categoryService->getAllCategories();
        return $this->render('category/index.html.twig', [
            'categories' => $categories,
            'category_page' => 'active',
        ]);
    }
    #[Route('/category/{id}/articles', name: 'app_category_articles')]
    public function showArticles(Category $category): Response
    {
        // Récupérez les articles de la catégorie
        $articles = $category->getArticles();

        return $this->render('category/articles.html.twig', [
            'category' => $category,
            'articles' => $articles,
            'category_page' => 'active',
        ]);
    }
}
