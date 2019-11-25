<?php

namespace App\Controller;

use App\Entity\Book;
use App\Service\AuthorService;
use App\Service\BookService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;

final class BookController extends AbstractController
{
    private $authorService;
    private $bookService;
    private $serializer;

    public function __construct(
        AuthorService $authorService,
        SerializerInterface $serializer,
        BookService $bookService
    ) {
        $this->authorService = $authorService;
        $this->bookService = $bookService;
        $this->serializer = $serializer;
    }

    public function index()
    {
        $books = $this->bookService->getAllBooks();

        if (!$books) {
            return $this->json([
                'message' => 'books not found',
            ]);
        }

        $jsonContent = $this->serializer->serialize($books, 'json', ['groups' => 'book']);

        return $this->json([
            'message' => 'all books',
            'data' => json_decode($jsonContent, JSON_UNESCAPED_SLASHES),
        ], 200);
    }

    public function show(int $id)
    {
        try {
            $book = $this->bookService->getBook($id);

            $jsonContent = $this->serializer->serialize($book, 'json', ['groups' => 'book']);
        } catch (\Throwable $th) {
            return $this->json(['message' => $th->getMessage()]);
        }

        return $this->json(['book' => json_decode($jsonContent, JSON_UNESCAPED_SLASHES)]);
    }

    public function create(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        try {
            $author = $this->authorService->getAuthor($data['author']);
        } catch (\Throwable $th) {
            return $this->json(['message' => $th->getMessage()]);
        }

        $book = new Book();
        $book->setAuthor($author);
        $book->setTitle($data['title']);
        $book->setLaunchDate(new \DateTime($data['launch_date']));
        $book->setCreatedAt(new \DateTime());

        $this->bookService->addBook($book);

        return $this->json([
            'message' => 'book inserted',
        ]);
    }


    public function update(Request $request, int $id)
    {
        $data = json_decode($request->getContent(), true);

        try {
            $book = $this->bookService->getBook($id);
        } catch (\Throwable $th) {
            return $this->json(['message' => $th->getMessage()]);
        }

        $book->setTitle($data['title']);
        $book->setLaunchDate(new \DateTime($data['launch_date']));
        $book->setUpdatedAt(new \DateTime());

        $this->bookService->addBook($book);

        return $this->json([
            'message' => 'book updated',
        ]);
    }

    public function delete(int $id)
    {
        try {
            $this->bookService->deleteBook($id);
        } catch (\Throwable $th) {
            return $this->json(['message' => $th->getMessage()]);
        }

        return $this->json(['message' => 'deleted book with id ' . $id]);
    }
}
