<?php

namespace App\Controller;


use App\Form\VenteType;
use App\Form\RegelemType;
use App\Form\RegelementType;
use App\Entity\ClientsVentes;
use App\Repository\TypesRepository;
use App\Repository\ClientsParRepository;
use App\Repository\ClientsVentesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin/Regel")
 */
class RegelementCliController extends AbstractController
{
    /**
     * @Route("/{id}/re", name="Regelement_index", methods={"GET"})
     */
    public function index(ClientsVentesRepository $ClientsVentesRepository,$id,ClientsParRepository $repo,TypesRepository $typeCa): Response
    {
        $client = $repo->findOneBy(['id' => $id]);
        return $this->render('admin/RegelementCli/index.html.twig', [
            'Regelement' => $ClientsVentesRepository->findVenteByClients($client,'Regelement'),
            'typee' => $typeCa->findAll(),
            'reg' => $id,
        ]);
    }
    /**
     * @Route("/new/{id}", name="Regelement_new", methods={"GET","POST"})
     */
    public function new(Request $request,TypesRepository $typeCa,$id,ClientsParRepository $repo): Response
    {
        $Vente = new ClientsVentes(); 
        $client = $repo->findOneBy(['id' => $id]);
        $form = $this->createForm(RegelemType::class, $Vente);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
           
            $entityManager = $this->getDoctrine()->getManager();
            $Vente->setType('Regelement')
                  ->setClients($client);
            $entityManager->persist($Vente);
            $entityManager->flush();
            return $this->redirectToRoute('Regelement_index',['id' => $id]);
        }
        return $this->render('admin/RegelementCli/new.html.twig', [
            'typee' => $typeCa->findAll(),
            'form' => $form->createView(),
            'Regelement' => $client,
        ]);
    }

    /**
     * @Route("/{id}/show", name="Regelement_show", methods={"GET"})
     */
    public function show(ClientsVentes $Regelement,TypesRepository $typeCa): Response
    {
        return $this->render('admin/RegelementCli/show.html.twig', [
            'Regelement' => $Regelement,
            'typee' => $typeCa->findAll(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="Regel_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ClientsVentes $Regelement,TypesRepository $typeCa): Response
    {
        $form = $this->createForm(RegelemType::class, $Regelement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('Regelement_index');
        }

        return $this->render('admin/RegelementCli/edit.html.twig', [
            'Regelement' => $Regelement,
            'typee' => $typeCa->findAll(),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/delete", name="Regel_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ClientsVentes $Regelement): Response
    {
        if ($this->isCsrfTokenValid('delete'.$Regelement->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($Regelement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('Regelement_index',['id' => $Regelement->getClients()->getId()]);
    }
}
