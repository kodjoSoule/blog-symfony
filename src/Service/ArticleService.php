<?php

namespace App\Service;

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;

class ArticleService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManagerInterface)
    {
        $this->entityManager = $entityManagerInterface;
    }
    public function createArticle(string $title, string $content): Article
    {
        $article = new Article();
        $article->setTitle($title);
        $article->setContent($content);

        $this->entityManager->persist($article);
        $this->entityManager->flush();

        return $article;
    }
    public function getArticle(int $id): ?Article
    {
        return $this->entityManager->getRepository(Article::class)->find($id);
    }

    public function getAllArticles(): array
    {
        return $this->entityManager->getRepository(Article::class)->findAll();
    }
    public function updateArticle(Article $article, string $title, string $content): Article
    {
        $article->setTitle($title);
        $article->setContent($content);

        $this->entityManager->flush();

        return $article;
    }
    public function deleteArticle(Article $article): void
    {
        $this->entityManager->remove($article);
        $this->entityManager->flush();
    }

    public function getFirstNArticles(int $n): array
    {
        return $this->entityManager->getRepository(Article::class)->findBy([], ['id' => 'ASC'], $n);
    }

    public function getLastNArticles(int $n): array
    {
        return $this->entityManager->getRepository(Article::class)->findBy([], ['id' => 'DESC'], $n);
    }

    public function getArticles($n, $isFirst = true): array
    {
        $orderBy = $isFirst ? 'ASC' : 'DESC';
        $articles = $this->entityManager->getRepository(Article::class)->findBy([], ['id' => $orderBy], $n);

        return $articles;
    }
}
