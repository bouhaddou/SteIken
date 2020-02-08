<?php

namespace App\Controller;

use App\Entity\ClientsPar;
use App\Form\ClientsParType;
use App\Repository\ClientsParRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/clientsPar")
 */
class ClientsParController extends AbstractController
{
    /**
     * @Route("/", name="clientsPar_index", methods={"GET"})
     */
    public function index(ClientsParRepository $clientsParRepository): Response
    {
        return $this->render('admin/clientsPar/index.html.twig', [
            'clientsPars' => $clientsParRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="clientsPar_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $clientsPar = new ClientsPar();
        $form = $this->createForm(ClientsParType::class, $clientsPar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($clientsPar);
            $entityManager->flush();

            return $this->redirectToRoute('clientsPar_index');
        }

        return $this->render('admin/clientsPar/new.html.twig', [
            'clientsPar' => $clientsPar,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/show", name="clientsPar_show", methods={"GET"})
     */
    public function show(ClientsPar $clientsPar): Response
    {
        return $this->render('admin/clientsPar/show.html.twig', [
            'clientsPar' => $clientsPar,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="clientsPar_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ClientsPar $clientsPar): Response
    {
        $form = $this->createForm(ClientsParType::class, $clientsPar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('clientsPar_index');
        }

        return $this->render('admin/clientsPar/edit.html.twig', [
            'clientsPar' => $clientsPar,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="clientsPar_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ClientsPar $clientsPar): Response
    {
        if ($this->isCsrfTokenValid('delete'.$clientsPar->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($clientsPar);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin/clientsPar_index');
    }
}
