<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MomentController extends AbstractController
{
    #[Route('/moment', name: 'moment')]
    public function index(): Response
    {
        return $this->render('moment/index.html.twig', [
            'controller_name' => 'MomentController',
        ]);
    }
}
