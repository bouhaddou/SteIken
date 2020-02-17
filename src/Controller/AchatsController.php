<?php

namespace App\Controller;


use App\Form\AchatType;
use App\Entity\AchatReg;
use App\Repository\TypesRepository;
use App\Repository\AchatRegRepository;
use App\Repository\FournisseursRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin/Achats")
 */
class AchatsController extends AbstractController
{
    /**
     * @Route("/{id}/Achat", name="Achats_index", methods={"GET"})
     */
    public function index(AchatRegRepository $AchatRegRepository,TypesRepository $typeCa,$id,FournisseursRepository $repo): Response
    {
        $frs = $repo->findOneBy(['id' => $id]);
        return $this->render('admin/Achats/index.html.twig', [
            'Achats' => $AchatRegRepository->findVenteByFrs($frs,'Achats'),
            'typee' => $typeCa->findAll(),
            'frs' => $id
        ]);
    }

    /**
     * @Route("/{id}/new", name="Achats_new", methods={"GET","POST"})
     */
    public function new(Request $request,TypesRepository $typeCa,$id,FournisseursRepository $repo): Response
    {
        $achat = new AchatReg();
        $form = $this->createForm(AchatType::class, $achat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $frs = $repo->findOneBy(['id' => $id]);
            $entityManager = $this->getDoctrine()->getManager();
            $achat->setType('Achats')
                    ->setFournisseur($frs);
            $entityManager->persist($achat);
            $entityManager->flush();
            return $this->redirectToRoute('Achats_index',['id' => $id]);
        }
        return $this->render('admin/Achats/new.html.twig', [
            'typee' => $typeCa->findAll(),
            'form' => $form->createView(),
            'frs' => $id
        ]);
    }

    /**
     * @Route("/{id}/sh", name="Achats_show", methods={"GET"})
     */
    public function show(AchatReg $achats,TypesRepository $typeCa): Response
    {
        return $this->render('admin/Achats/show.html.twig', [
            'Achat' => $achats,
            'typee' => $typeCa->findAll(),
            'Achat' => $achats,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="Achats_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, AchatReg $achats,TypesRepository $typeCa): Response
    {
        $form = $this->createForm(AchatType::class, $achats);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('Achats_index',['id' => $achats->getFournisseur()->getId()]);
        }
        return $this->render('admin/Achats/edit.html.twig', [
            'Achat' => $achats,
            'typee' => $typeCa->findAll(),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="Achats_delete", methods={"DELETE"})
     */
    public function delete(Request $request, AchatReg $achats): Response
    {
        if ($this->isCsrfTokenValid('delete'.$achats->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($achats);
            $entityManager->flush();
        }

        return $this->redirectToRoute('Achats_index',['id' => $achats->getFournisseur()->getId()]);
    }
}
