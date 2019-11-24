<?php


namespace App\Service;


use App\Entity\Author;
use App\Repository\AuthorRepository;
use Doctrine\ORM\EntityNotFoundException;

final class AuthorService
{
    private $authorRepository;

    public function __construct(AuthorRepository $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    public function getAuthor(int $authorId): Author
    {
        $author = $this->authorRepository->find($authorId);

        if (!$author) {
            throw new EntityNotFoundException('Author with id ' . $authorId . ' does not exist!');
        }
        return $author;
    }

    public function getAllAuthors(): ?array
    {
        return $this->authorRepository->findAll();
    }

    public function addAuthor(Author $author): Author
    {
        $this->authorRepository->save($author);
    }

    public function deleteArticle(int $authorId): void
    {
        $author = $this->authorRepository->find($authorId);
        if (!$author) {
            throw new EntityNotFoundException('Author with id '.$authorId.' does not exist!');
        }
        
        $this->authorRepository->delete($author);
    }
}