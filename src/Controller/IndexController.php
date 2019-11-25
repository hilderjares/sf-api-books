<?php 

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends AbstractController
{
    public function index()
    {
        return new Response('<h1>API somee.social</h1>');
    }

    public function documentation()
    {
        return new Response('doc');
    }
}
