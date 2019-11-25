<?php


namespace App\Controller;

use App\Entity\Author;
use App\Service\AuthorService;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

final class AuthorController extends AbstractController
{
    private $authorService;
    private $serializer;

    public function __construct(AuthorService $authorService, SerializerInterface $serializer)
    {
        $this->authorService = $authorService;
        $this->serializer = $serializer;
    }

    public function index()
    {
        $authors = $this->authorService->getAllAuthors();

        if (!$authors) {
            return $this->json([
                'message' => 'author not found',
            ]);
        }

        $jsonContent = $this->serializer->serialize($authors, 'json', [
            'circular_reference_handler' => function ($object) {
                return $object->getBooks();
            }
        ]);

        return $this->json([
            'authors' => json_decode($jsonContent, JSON_UNESCAPED_SLASHES),
        ], 200);
    }

    public function show(int $id)
    {
        try {
            $author = $this->authorService->getAuthor($id);
        } catch (\Throwable $th) {
            return $this->json(['message' => $th->getMessage()]);
        }

        $jsonContent = $this->serializer->serialize($author, 'json', [
            'circular_reference_handler' => function ($object) {
                return $object->getBooks();
            }
        ]);

        return $this->json([
            'author' => json_decode($jsonContent, JSON_UNESCAPED_SLASHES),
        ], 200);
    }

    public function create(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        $author = new Author();
        $author->setName($data['name']);
        $author->setDateOfBirth(new \DateTime($data['date_of_birth']));
        $author->setCreatedAt(new \DateTime());

        $this->authorService->addAuthor($author);

        return $this->json([
            'message' => 'author inserted',
        ]);
    }

    public function update(Request $request, int $id)
    {
        $data = json_decode($request->getContent(), true);

        try {
            $author = $this->authorService->getAuthor($id);
        } catch (\Throwable $th) {
            return $this->json(['message' => $th->getMessage()]);
        }

        $author->setName($data['name']);
        $author->setDateOfBirth(new \DateTime($data['date_of_birth']));
        $author->setUpdatedAt(new \DateTime());

        $this->authorService->addAuthor($author);

        return $this->json([
            'message' => 'author updated',
        ]);
    }

    public function delete(int $id)
    {
        try {
            $author = $this->authorService->deleteAuthor($id);
        } catch (\Throwable $th) {
            return $this->json(['message' => $th->getMessage()]);
        }

        return $this->json(['message' => 'deleted author with id ' . $id,]);
    }
}
