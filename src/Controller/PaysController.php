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
        $pays = $this->em->getRepository(Pays::class)->findAll();

        return $this->render('pays/index.html.twig',[
            'pays' => $pays
        ]);
    }

    #[Route('/pays/add', name: 'pays_add')]
    public function add(Request $request): Response
    {
        $notification = null;
        $pays = new Pays();
        $form = $this->createForm(PaysType::class, $pays);
        $form ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $pays = $form ->getData();

            $this->em->persist($pays);
            $this->em->flush();

            $notification = "Le pays a été enrégistré  avec succès";

            unset($entity);
            unset($form);
            $pays = new Pays();
            $form = $this->createForm( PaysType::class, $pays);

        }


        return $this->render('pays/add.html.twig', [
            'form' => $form->createView(),
            'notification' => $notification
        ]);
    }


    #[Route('/pays/{id}', name: 'pays_remove')]
    public function deleteProduct(int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $pays = $entityManager->getRepository(Pays::class)->find($id);
        $entityManager->remove($pays);
        $entityManager->flush();

        return $this->redirectToRoute("pays");
    }


}