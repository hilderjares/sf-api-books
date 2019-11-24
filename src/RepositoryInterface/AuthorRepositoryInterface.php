<?php


namespace App\RepositoryInterface;


use App\Entity\Author;

interface AuthorRepositoryInterface
{
    public function find(int $authorId): ?Author;
    public function save(Author $author): void;
    public function findAll(): ?array;
    public function delete(Author $author): void;
}