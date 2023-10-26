<?php
// src/Service/CommentService.php

namespace App\Service;

use App\Entity\Article;
use App\Entity\Comment;
use Doctrine\ORM\EntityManagerInterface;

class CommentService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function createComment(Comment $comment)
    {
        // Logique de création d'un commentaire
        $this->entityManager->persist($comment);
        $this->entityManager->flush();
    }

    public function updateComment(Comment $comment)
    {
        // Logique de mise à jour d'un commentaire
        $this->entityManager->flush();
    }

    public function deleteComment(Comment $comment)
    {
        // Logique de suppression d'un commentaire
        $this->entityManager->remove($comment);
        $this->entityManager->flush();
    }

    public function getCommentById($id)
    {
        // Récupérer un commentaire par son ID
        return $this->entityManager->getRepository(Comment::class)->find($id);
    }

    public function getAllComments()
    {
        // Récupérer tous les commentaires
        return $this->entityManager->getRepository(Comment::class)->findAll();
    }
    public function getTotalCommentCount(): int
    {
        // Utilisez l'EntityManager pour interagir avec la base de données et compter les commentaires
        $commentRepository = $this->entityManager->getRepository(Comment::class);
        $totalComments = $commentRepository->createQueryBuilder('c')
            ->select('COUNT(c.id)')
            ->getQuery()
            ->getSingleScalarResult();

        return $totalComments;
    }
    public function getTotalCommentCountForArticle(Article $article): int
    {
        // Utilisez l'EntityManager pour interagir avec la base de données et compter les commentaires pour un article spécifique
        $commentRepository = $this->entityManager->getRepository(Comment::class);
        $totalComments = $commentRepository->createQueryBuilder('c')
            ->select('COUNT(c.id)')
            ->where('c.article = :article')
            ->setParameter('article', $article)
            ->getQuery()
            ->getSingleScalarResult();

        return $totalComments;
    }
    // Vous pouvez ajouter d'autres méthodes liées aux commentaires en fonction de vos besoins.
}
