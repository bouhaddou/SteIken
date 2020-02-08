<?php

namespace App\Controller;


use App\Form\VenteType;
use App\Form\RegelemType;
use App\Form\RegelementType;
use App\Entity\ClientsVentes;
use App\Repository\TypesRepository;
use App\Repository\ClientsVentesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin/Regelement")
 */
class RegelementCliController extends AbstractController
{
    /**
     * @Route("/", name="Regelement_index", methods={"GET"})
     */
    public function index(ClientsVentesRepository $ClientsVentesRepository,TypesRepository $typeCa): Response
    {
        return $this->render('admin/RegelementCli/index.html.twig', [
            'Regelement' => $ClientsVentesRepository->findBy(['type' => 'Regelement']),
            'typee' => $typeCa->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="Regelement_new", methods={"GET","POST"})
     */
    public function new(Request $request,TypesRepository $typeCa): Response
    {
        $Vente = new ClientsVentes();
        $form = $this->createForm(RegelemType::class, $Vente);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $Vente->setType('Regelement');
            $entityManager->persist($Vente);
            $entityManager->flush();
            return $this->redirectToRoute('Regelement_index');
        }
        return $this->render('admin/RegelementCli/new.html.twig', [
            'typee' => $typeCa->findAll(),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/show", name="Regelement_show", methods={"GET"})
     */
    public function show(ClientsVentes $Regelement,TypesRepository $typeCa): Response
    {
        return $this->render('admin/Regelement/show.html.twig', [
            'Vente' => $Regelement,
            'typee' => $typeCa->findAll(),
            'Vente' => $Regelement,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="Regelement_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ClientsVentes $Regelement,TypesRepository $typeCa): Response
    {
        $form = $this->createForm(RegelemType::class, $Regelement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('Regelement_index');
        }

        return $this->render('admin/Regelement/edit.html.twig', [
            'Vente' => $Regelement,
            'typee' => $typeCa->findAll(),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="Regelement_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ClientsVentes $Regelement): Response
    {
        if ($this->isCsrfTokenValid('delete'.$Regelement->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($Regelement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('Regelement_index');
    }
}
