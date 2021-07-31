<?php

namespace App\Controller;

use App\Entity\Moment;
use App\Entity\Visiter;
use App\Form\VisiterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VisiterController extends AbstractController
{
    private  $em ;
    public function __construct(EntityManagerInterface $entityManager){
        $this ->em = $entityManager;
    }

    #[Route('/visiter', name: 'visiter')]
    public function index(): Response
    {
        $visiter = $this->em->getRepository(Visiter::class)->findAll();

        return $this->render('visiter/index.html.twig',[
            'visiter' => $visiter
        ]);
    }

    #[Route('/visiter/add', name: 'visiter_add')]
    public function add(Request $request): Response
    {
        $notification = null;
        $visiter = new Visiter();
        $form = $this->createForm(VisiterType::class, $visiter);
        $form ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $visiter = $form ->getData();

            $nomMus = $visiter->getNomMus();
            $visiter ->setNomMus($nomMus );

            $this->em->persist($visiter);
            $this->em->flush();

            $notification = "La visite a été enrégistré  avec succès";

            unset($entity);
            unset($form);
            $visiter = new Visiter();
            $form = $this->createForm( VisiterType::class, $visiter);

        }



        return $this->render('visiter/add.html.twig', [
            'form' => $form->createView(),
            'notification' => $notification,
        ]);

    }


    #[Route('/visiter/{id}', name: 'visiter_remove')]
    public function deleteProduct(int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $visiter = $entityManager->getRepository(Visiter::class)->find($id);
        $entityManager->remove($visiter);
        $entityManager->flush();

        return $this->redirectToRoute("visiter");
    }


}