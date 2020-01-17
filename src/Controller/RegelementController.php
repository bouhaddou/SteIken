<?php

namespace App\Controller;

use App\Entity\Regelement;
use App\Form\RegelementType;
use App\Repository\RegelementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/regelement")
 */
class RegelementController extends AbstractController
{
    /**
     * @Route("/", name="regelement_index", methods={"GET"})
     */
    public function index(RegelementRepository $regelementRepository): Response
    {
        return $this->render('Admin/regelement/index.html.twig', [
            'regelements' => $regelementRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="regelement_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $regelement = new Regelement();
        $form = $this->createForm(RegelementType::class, $regelement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($regelement);
            $entityManager->flush();

            return $this->redirectToRoute('regelement_index');
        }

        return $this->render('Admin/regelement/new.html.twig', [
            'regelement' => $regelement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="regelement_show", methods={"GET"})
     */
    public function show(Regelement $regelement): Response
    {
        return $this->render('Admin/regelement/show.html.twig', [
            'regelement' => $regelement,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="regelement_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Regelement $regelement): Response
    {
        $form = $this->createForm(RegelementType::class, $regelement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('regelement_index');
        }

        return $this->render('Admin/regelement/edit.html.twig', [
            'regelement' => $regelement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="regelement_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Regelement $regelement): Response
    {
        if ($this->isCsrfTokenValid('delete'.$regelement->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($regelement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('regelement_index');
    }
}
