<?php

namespace App\Controller;

use App\Entity\Pays;
use App\Form\PaysType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class PaysController extends AbstractController
{
    private  $em ;
    public function __construct(EntityManagerInterface $entityManager){
        $this ->em = $entityManager;
    }

    #[Route('/pays', name: 'pays')]
    public function index(): Response
    {
        return $this->render('pays/index.html.twig');
    }

    #[Route('/pays/add', name: 'pays_add')]
    public function add(Request $request): Response
    {

        $pays = new Pays();
        $form = $this->createForm(PaysType::class, $pays);
        $form ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $pays = $form ->getData();

            $this->em->persist($pays);
            $this->em->flush();

            $this->addFlash("success" , "Pays crée avec succès");
        }


        return $this->render('pays/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}