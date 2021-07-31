<?php

namespace App\Controller;

use App\Entity\Ouvrage;
use App\Form\OuvrageType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OuvrageController extends AbstractController
{
    private  $em ;
    public function __construct(EntityManagerInterface $entityManager){
        $this ->em = $entityManager;
    }

    #[Route('/ouvrage', name: 'ouvrage')]
    public function index(): Response
    {
        $ouvrage = $this->em->getRepository(Ouvrage::class)->findAll();

        return $this->render('ouvrage/index.html.twig', [
            'ouvrage' => $ouvrage,
        ]);
    }


    #[Route('/ouvrage/add', name: 'ouvrage_add')]
    public function add(Request $request): Response
    {
        $notification = null;
        $ouvrage = new Ouvrage();
        $form = $this->createForm(OuvrageType::class, $ouvrage);
        $form ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $ouvrage = $form ->getData();

            $this->em->persist($ouvrage);
            $this->em->flush();

            $notification = "L'ouvrage  a été enrégistré  avec succès";

            unset($entity);
            unset($form);
            $ouvrage = new Ouvrage();
            $form = $this->createForm( OuvrageType::class, $ouvrage);

        }



        return $this->render('ouvrage/add.html.twig', [
            'form' => $form->createView(),
            'notification' => $notification,
        ]);

    }


    #[Route('/ouvrage/{id}', name: 'ouvrage_remove')]
    public function deleteProduct(int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $ouvrage = $entityManager->getRepository(Ouvrage::class)->find($id);
        $entityManager->remove($ouvrage);
        $entityManager->flush();

        return $this->redirectToRoute("ouvrage");
    }

}
