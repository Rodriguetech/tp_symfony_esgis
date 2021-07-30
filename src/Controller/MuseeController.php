<?php

namespace App\Controller;

use App\Entity\Musee;
use App\Form\MuseeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MuseeController extends AbstractController
{

    private  $em ;
    public function __construct(EntityManagerInterface $entityManager){
        $this ->em = $entityManager;
    }
    #[Route('/musee', name: 'musee')]
    public function index(): Response
    {
        $musee = $this->em->getRepository(Musee::class)->findAll();

        return $this->render('musee/index.html.twig',[
            'musee' => $musee
        ]);
    }


    #[Route('/musee/add', name: 'musee_add')]
    public function add(Request $request): Response
    {

        $musee = new Musee();
        $form = $this->createForm(MuseeType::class, $musee);
        $form ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $musee = $form ->getData();

            $this->em->persist($musee);
            $this->em->flush();

            $this->addFlash("success" , "Musée crée avec succès");
        }

        return $this->render('musee/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
