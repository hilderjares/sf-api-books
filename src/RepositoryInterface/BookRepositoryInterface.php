<?php

namespace App\RepositoryInterface;

use App\Entity\Book;

interface BookRepositoryInterface
{
    public function find($bookId, $lockMode = NULL, $lockVersion = NULL);
    public function save(Book $book): void;
    public function findAll();
    public function delete(Book $book): void;
}