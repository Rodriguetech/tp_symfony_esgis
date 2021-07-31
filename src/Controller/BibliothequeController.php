<?php

namespace App\Controller;

use App\Entity\Bibliotheque;
use App\Form\BibliothequeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BibliothequeController extends AbstractController
{

    private  $em ;
    public function __construct(EntityManagerInterface $entityManager){
        $this ->em = $entityManager;
    }


    #[Route('/bibliotheque', name: 'bibliotheque')]
    public function index(): Response
    {
        $bibliotheque = $this->em->getRepository(Bibliotheque::class)->findAll();

        return $this->render('bibliotheque/index.html.twig', [
            'bibliotheque' => $bibliotheque,
        ]);
    }


    #[Route('/bibliotheque/add', name: 'bibliotheque_add')]
    public function add(Request $request): Response
    {
        $notification = null;
        $bibliotheque = new Bibliotheque();
        $form = $this->createForm(BibliothequeType::class, $bibliotheque);
        $form ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $bibliotheque = $form ->getData();

            $this->em->persist($bibliotheque);
            $this->em->flush();

            $notification = "La bibliotheque a été enrégistré  avec succès";

            unset($entity);
            unset($form);
            $bibliotheque = new Bibliotheque();
            $form = $this->createForm( BibliothequeType::class, $bibliotheque);

        }



        return $this->render('bibliotheque/add.html.twig', [
            'form' => $form->createView(),
            'notification' => $notification,
        ]);

    }


    #[Route('/bibliotheque/{id}', name: 'bibliotheque_remove')]
    public function deleteProduct(int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $bibliotheque = $entityManager->getRepository(Bibliotheque::class)->find($id);
        $entityManager->remove($bibliotheque);
        $entityManager->flush();

        return $this->redirectToRoute("bibliotheque");
    }



}
