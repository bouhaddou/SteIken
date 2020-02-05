<?php

namespace App\Controller;

use App\Entity\Mode;
use App\Form\ModeType;
use App\Repository\ModeRepository;
use App\Repository\TypesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin/mode")
 */
class ModeController extends AbstractController
{
    /**
     * @Route("/", name="mode_index", methods={"GET"})
     */
    public function index(ModeRepository $modeRepository,TypesRepository $typeCa): Response
    {
        return $this->render('admin/mode/index.html.twig', [
            'modes' => $modeRepository->findAll(),
            'typee' => $typeCa->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="mode_new", methods={"GET","POST"})
     */
    public function new(Request $request,TypesRepository $typeCa): Response
    {
        $mode = new Mode();
        $form = $this->createForm(ModeType::class, $mode);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($mode);
            $entityManager->flush();

            return $this->redirectToRoute('mode_index');
        }

        return $this->render('admin/mode/new.html.twig', [
            'mode' => $mode,
            'typee' => $typeCa->findAll(),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="mode_show", methods={"GET"})
     */
    public function show(Mode $mode,TypesRepository $typeCa): Response
    {
        return $this->render('admin/mode/show.html.twig', [
            'typee' => $typeCa->findAll(),
            'mode' => $mode,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="mode_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Mode $mode,TypesRepository $typeCa): Response
    {
        $form = $this->createForm(ModeType::class, $mode);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('mode_index');
        }

        return $this->render('admin/mode/edit.html.twig', [
            'mode' => $mode,
            'typee' => $typeCa->findAll(),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="mode_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Mode $mode): Response
    {
        if ($this->isCsrfTokenValid('delete'.$mode->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($mode);
            $entityManager->flush();
        }

        return $this->redirectToRoute('mode_index');
    }
}
