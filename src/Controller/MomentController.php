<?php

namespace App\Controller;

use App\Entity\Moment;
use App\Form\MomentType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MomentController extends AbstractController
{

    private  $em ;
    public function __construct(EntityManagerInterface $entityManager){
        $this ->em = $entityManager;
    }

    #[Route('/moment', name: 'moment')]
    public function index(): Response
    {
        $moment = $this->em->getRepository(Moment::class)->findAll();

        return $this->render('moment/index.html.twig', [
            'moment' => $moment,
        ]);
    }


    #[Route('/moment/add', name: 'moment_add')]
    public function add(Request $request): Response
    {
        $moment = new Moment();
        $form = $this->createForm(MomentType::class, $moment);
        $form ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $moment = $form ->getData();

            $this->em->persist($moment);
            $this->em->flush();


            return $this->redirectToRoute("visiter_add");

        }

        return $this->render('moment/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
