<?php

namespace App\Controller;

use App\Entity\Fournisseurs;
use App\Form\FournisseursType;
use App\Repository\FournisseursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/fournisseurs")
 */
class FournisseursController extends AbstractController
{
    /**
     * @Route("/", name="fournisseurs_index", methods={"GET"})
     */
    public function index(FournisseursRepository $fournisseursRepository): Response
    {
        return $this->render('admin/fournisseurs/index.html.twig', [
            'fournisseurs' => $fournisseursRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="fournisseurs_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $fournisseur = new Fournisseurs();
        $form = $this->createForm(FournisseursType::class, $fournisseur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($fournisseur);
            $entityManager->flush();

            return $this->redirectToRoute('fournisseurs_index');
        }

        return $this->render('admin/fournisseurs/new.html.twig', [
            'fournisseur' => $fournisseur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/show", name="fournisseurs_show", methods={"GET"})
     */
    public function show(Fournisseurs $fournisseur): Response
    {
        return $this->render('admin/fournisseurs/show.html.twig', [
            'fournisseur' => $fournisseur,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="fournisseurs_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Fournisseurs $fournisseur): Response
    {
        $form = $this->createForm(FournisseursType::class, $fournisseur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('fournisseurs_index');
        }

        return $this->render('admin/fournisseurs/edit.html.twig', [
            'fournisseur' => $fournisseur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="fournisseurs_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Fournisseurs $fournisseur): Response
    {
        if ($this->isCsrfTokenValid('delete'.$fournisseur->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($fournisseur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('fournisseurs_index');
    }

   

}

