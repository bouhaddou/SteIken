<?php

namespace App\Controller;

use App\Entity\Achats;
use App\Form\AchatsType;
use App\Repository\AchatsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/achats")
 */
class AchatsController extends AbstractController
{
    /**
     * @Route("/", name="achats_index", methods={"GET"})
     */
    public function index(AchatsRepository $achatsRepository): Response
    {
        return $this->render('Admin/achats/index.html.twig', [
            'achats' => $achatsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="achats_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $achat = new Achats();
        $form = $this->createForm(AchatsType::class, $achat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($achat);
            $entityManager->flush();

            return $this->redirectToRoute('achats_index');
        }

        return $this->render('Admin/achats/new.html.twig', [
            'achat' => $achat,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="achats_show", methods={"GET"})
     */
    public function show(Achats $achat): Response
    {
        return $this->render('Admin/achats/show.html.twig', [
            'achat' => $achat,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="achats_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Achats $achat): Response
    {
        $form = $this->createForm(AchatsType::class, $achat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('achats_index');
        }

        return $this->render('Admin/achats/edit.html.twig', [
            'achat' => $achat,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="achats_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Achats $achat): Response
    {
        if ($this->isCsrfTokenValid('delete'.$achat->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($achat);
            $entityManager->flush();
        }

        return $this->redirectToRoute('achats_index');
    }
}
