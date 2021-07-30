<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReferencerController extends AbstractController
{
    #[Route('/referencer', name: 'referencer')]
    public function index(): Response
    {
        return $this->render('referencer/index.html.twig', [
            'controller_name' => 'ReferencerController',
        ]);
    }
}
