<?php

// src/Service/CategoryService.php

namespace App\Service;

use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;

class CategoryService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    // Obtient toutes les catégories
    public function getAllCategories(): array
    {
        return $this->entityManager->getRepository(Category::class)->findAll();
    }

    // Obtient une catégorie par son ID
    public function getCategoryById(int $id): ?Category
    {
        return $this->entityManager->getRepository(Category::class)->find($id);
    }

    // Crée une nouvelle catégorie
    public function createCategory(Category $category): void
    {
        $this->entityManager->persist($category);
        $this->entityManager->flush();
    }

    // Met à jour une catégorie existante
    public function updateCategory(Category $category): void
    {
        $this->entityManager->flush();
    }

    // Supprime une catégorie
    public function deleteCategory(Category $category): void
    {
        $this->entityManager->remove($category);
        $this->entityManager->flush();
    }
}
