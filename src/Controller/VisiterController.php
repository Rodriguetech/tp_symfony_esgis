<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VisiterController extends AbstractController
{
    #[Route('/visiter', name: 'visiter')]
    public function index(): Response
    {
        return $this->render('visiter/index.html.twig', [
            'controller_name' => 'VisiterController',
        ]);
    }
}
