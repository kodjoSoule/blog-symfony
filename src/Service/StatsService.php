<?php
namespace App\Service ;
use App\Entity\User ;
use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;


class StatsService{
    private EntityManagerInterface $entityManager ;
    public function __construct(EntityManagerInterface $entityManager ){
        $this->entityManager = $entityManager;
    }
    public function getTotalUsers(): int
    {
        $userRepository = $this->entityManager->getRepository(User::class);
        return $userRepository->createQueryBuilder('u')
            ->select('COUNT(u.id)')
            ->getQuery()
            ->getSingleScalarResult();
    }
    public function getTotalArticles(): int
    {
        $articleRepository = $this->entityManager->getRepository(Article::class);
        return $articleRepository->createQueryBuilder('u')
        ->select('COUNT(u.id)')->getQuery()
        ->getSingleScalarResult();

    }
}