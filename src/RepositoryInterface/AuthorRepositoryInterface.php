<?php

namespace App\RepositoryInterface;

use App\Entity\Author;

interface AuthorRepositoryInterface
{
    public function find($authorId, $lockMode = NULL, $lockVersion = NULL);
    public function save(Author $author): void;
    public function findAll();
    public function delete(Author $author): void;
}