<?php

namespace App\Repository;

use App\Entity\Author;
use App\RepositoryInterface\AuthorRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

final class AuthorRepository extends ServiceEntityRepository implements AuthorRepositoryInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager, ManagerRegistry $registry)
    {
        $this->entityManager = $entityManager;

        parent::__construct($registry, Author::class);
    }

    public function save(Author $author): void
    {
        $this->entityManager->persist($author);
        $this->entityManager->flush();
    }

    public function delete(Author $author): void
    {
        $this->entityManager->remove($author);
        $this->entityManager->flush();
    }
}
