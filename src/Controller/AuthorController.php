<?php


namespace App\Controller;


use App\Service\AuthorService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class AuthorController extends AbstractController
{
    private $authorService;

    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }

    public function index()
    {
        $authors = $this->authorService->getAllAuthors();

        if (!$authors) {
            return $this->json([
                'message' => 'author not found',
            ]);
        }

        return $this->json([
            'message' => 'all authors',
            'data' => $authors,
        ]);
    }
}