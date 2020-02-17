<?php

namespace App\Controller;


use App\Entity\AchatReg;
use App\Form\RegelementsType;
use App\Repository\TypesRepository;
use App\Repository\AchatRegRepository;
use App\Repository\FournisseursRepository;
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
     * @Route("/{id}/regVente", name="Regelements_index", methods={"GET"})
     */
    public function index(AchatRegRepository $AchatRegRepository,TypesRepository $typeCa,FournisseursRepository $repo,$id): Response
    {
        $frs = $repo->findOneBy(['id' => $id]);
        return $this->render('admin/Regelements/index.html.twig', [
            'Regelements' => $AchatRegRepository->findVenteByFrs($frs,'Regelements'),
            'typee' => $typeCa->findAll(),
            'regle' => $id
        ]);
    }

    /**
     * @Route("/{id}/new", name="Regelements_new", methods={"GET","POST"})
     */
    public function new(Request $request,TypesRepository $typeCa,$id,FournisseursRepository $repo): Response
    {
        $regelementss = new AchatReg();
        $form = $this->createForm(RegelementsType::class, $regelementss);
        $form->handleRequest($request);
        $frs = $repo->findOneBy(['id' => $id]);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $regelementss->setType('Regelements')
                         ->setFournisseur($frs);
            $entityManager->persist($regelementss);
            $entityManager->flush();
            return $this->redirectToRoute('Regelements_index',['id' => $id]);
        }
        return $this->render('admin/Regelements/new.html.twig', [
           'regle' => $id,
            'typee' => $typeCa->findAll(),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/sh", name="Regelements_show", methods={"GET"})
     */
    public function show(AchatReg $Regelements,TypesRepository $typeCa): Response
    {
        return $this->render('admin/Regelements/show.html.twig', [
            'Regelement' => $Regelements,
            'typee' => $typeCa->findAll(),
            
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
            return $this->redirectToRoute('Regelements_index',['id' => $Regelements->getFournisseur()->getId() ]);
        }

        return $this->render('admin/Regelements/edit.html.twig', [
            'Regelement' => $Regelements,
            'typee' => $typeCa->findAll(),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/delete", name="Regelements_delete", methods={"DELETE"})
     */
    public function delete(Request $request, AchatReg $Regelements): Response
    {
        if ($this->isCsrfTokenValid('delete'.$Regelements->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($Regelements);
            $entityManager->flush();
        }

        return $this->redirectToRoute('Regelements_index',['id' => $Regelements->getFournisseur()->getId() ]);
    }
}
