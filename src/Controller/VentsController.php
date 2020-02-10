<?php

namespace App\Controller;


use App\Form\VenteType;
use App\Entity\ClientsVentes;
use App\Repository\ClientsParRepository;
use App\Repository\TypesRepository;
use App\Repository\ClientsVentesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin/Vents")
 */
class VentsController extends AbstractController
{
    /**
     * @Route("/{id}", name="Vents_index", methods={"GET"})
     */
    public function index(ClientsVentesRepository $ClientsVentesRepository,$id,TypesRepository $typeCa,ClientsParRepository $repo): Response
    {
        $client = $repo->findOneBy(['id' => $id]);
        return $this->render('admin/Vents/index.html.twig', [
            'Vents' => $ClientsVentesRepository->findVenteByClients($client,'Vents'),
            'typee' => $typeCa->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="Vents_new", methods={"GET","POST"})
     */
    public function new(Request $request,TypesRepository $typeCa): Response
    {
        $Vente = new ClientsVentes();
        $form = $this->createForm(VenteType::class, $Vente);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $Vente->setType('Vents');
            $entityManager->persist($Vente);
            $entityManager->flush();
            return $this->redirectToRoute('Vents_index');
        }
        return $this->render('admin/Vents/new.html.twig', [
            'typee' => $typeCa->findAll(),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/show", name="Vents_show", methods={"GET"})
     */
    public function show(ClientsVentes $Vents,TypesRepository $typeCa): Response
    {
        return $this->render('admin/Vents/show.html.twig', [
            'Vente' => $Vents,
            'typee' => $typeCa->findAll(),
            'Vente' => $Vents,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="Vents_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ClientsVentes $Vents,TypesRepository $typeCa): Response
    {
        $form = $this->createForm(VenteType::class, $Vents);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('Vents_index');
        }

        return $this->render('admin/Vents/edit.html.twig', [
            'Vente' => $Vents,
            'typee' => $typeCa->findAll(),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/delete", name="Vents_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ClientsVentes $Vents): Response
    {
        if ($this->isCsrfTokenValid('delete'.$Vents->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($Vents);
            $entityManager->flush();
        }

        return $this->redirectToRoute('Vents_index');
    }
}
