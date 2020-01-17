<?php

namespace App\Controller;

use App\Entity\ModeRegelement;
use App\Form\ModeRegelementType;
use App\Repository\ModeRegelementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/mode/regelement")
 */
class ModeRegelementController extends AbstractController
{
    /**
     * @Route("/", name="mode_regelement_index", methods={"GET"})
     */
    public function index(ModeRegelementRepository $modeRegelementRepository): Response
    {
        return $this->render('Admin/mode_regelement/index.html.twig', [
            'mode_regelements' => $modeRegelementRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="mode_regelement_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $modeRegelement = new ModeRegelement();
        $form = $this->createForm(ModeRegelementType::class, $modeRegelement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($modeRegelement);
            $entityManager->flush();

            return $this->redirectToRoute('mode_regelement_index');
        }

        return $this->render('Admin/mode_regelement/new.html.twig', [
            'mode_regelement' => $modeRegelement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="mode_regelement_show", methods={"GET"})
     */
    public function show(ModeRegelement $modeRegelement): Response
    {
        return $this->render('Admin/mode_regelement/show.html.twig', [
            'mode_regelement' => $modeRegelement,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="mode_regelement_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ModeRegelement $modeRegelement): Response
    {
        $form = $this->createForm(ModeRegelementType::class, $modeRegelement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('mode_regelement_index');
        }

        return $this->render('Admin/mode_regelement/edit.html.twig', [
            'mode_regelement' => $modeRegelement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="mode_regelement_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ModeRegelement $modeRegelement): Response
    {
        if ($this->isCsrfTokenValid('delete'.$modeRegelement->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($modeRegelement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('mode_regelement_index');
    }
}
