<?php

namespace App\Repository;

use App\Entity\Author;
use App\RepositoryInterface\AuthorRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

final class AuthorRepository implements AuthorRepositoryInterface
{
    private $entityManager;
    private $objectRepository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->objectRepository = $this->entityManager->getRepository(Author::class);
    }

    public function find(int $authorId): ?Author
    {
        return $this->objectRepository->find($authorId);
    }

    public function save(Author $author): void
    {
        $this->entityManager->persist($author);
        $this->entityManager->flush();
    }

    public function findAll(): ?array
    {
        return $this->objectRepository->findAll();
    }

    public function delete(Author $author): void
    {
        $this->entityManager->remove($author);
        $this->entityManager->flush();
    }
}
