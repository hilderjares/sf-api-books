<?php

namespace App\Service;

use App\Entity\Author;
use App\Entity\Book;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityNotFoundException;

final class BookService
{
    private $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function getBook(int $bookId): Book
    {
        $book = $this->bookRepository->find($bookId);

        if (!$book) {
            throw new EntityNotFoundException('Author with id ' . $bookId . ' does not exist!');
        }
        return $book;
    }

    public function getAllBooks(): ?array
    {
        return $this->bookRepository->findAll();
    }

    public function addBook(Book $book): void
    {
        $this->bookRepository->save($book);
    }

    public function deleteBook(int $bookId): void
    {
        $book = $this->bookRepository->find($bookId);
        if (!$book) {
            throw new EntityNotFoundException('Book with id '.$bookId.' does not exist!');
        }
        
        $this->bookRepository->delete($book);
    }
}