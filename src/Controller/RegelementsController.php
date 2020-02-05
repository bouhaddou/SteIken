<?php

namespace App\Controller;


use App\Form\AchatType;
use App\Entity\AchatReg;
use App\Form\RegelementsType;
use App\Repository\TypesRepository;
use App\Repository\AchatRegRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin/Regelements")
 */
class RegelementsController extends AbstractController
{
    /**
     * @Route("/", name="Regelements_index", methods={"GET"})
     */
    public function index(AchatRegRepository $AchatRegRepository,TypesRepository $typeCa): Response
    {
        return $this->render('admin/Regelements/index.html.twig', [
            'Regelements' => $AchatRegRepository->findAll(),
            'typee' => $typeCa->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="Regelements_new", methods={"GET","POST"})
     */
    public function new(Request $request,TypesRepository $typeCa): Response
    {
        $achat = new AchatReg();
        $form = $this->createForm(RegelementsType::class, $achat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
         
            $entityManager->persist($achat);
            $entityManager->flush();

            return $this->redirectToRoute('Regelements_index');
        }

        return $this->render('admin/Regelements/new.html.twig', [
           
            'typee' => $typeCa->findAll(),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="Regelements_show", methods={"GET"})
     */
    public function show(AchatReg $Regelements,TypesRepository $typeCa): Response
    {
        return $this->render('admin/Regelements/show.html.twig', [
            'Regelement' => $Regelements,
            'typee' => $typeCa->findAll(),
            'Achat' => $Regelements,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="Regelements_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, AchatReg $Regelements,TypesRepository $typeCa): Response
    {
        $form = $this->createForm(RegelementsType::class, $Regelements);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('Regelements_index');
        }

        return $this->render('admin/Regelements/edit.html.twig', [
            'Regelement' => $Regelements,
            'typee' => $typeCa->findAll(),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="Regelements_delete", methods={"DELETE"})
     */
    public function delete(Request $request, AchatReg $Regelements): Response
    {
        if ($this->isCsrfTokenValid('delete'.$Regelements->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($Regelements);
            $entityManager->flush();
        }

        return $this->redirectToRoute('Regelements_index');
    }
}
