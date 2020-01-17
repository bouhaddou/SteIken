<?php

namespace App\Controller;

use App\Repository\FournisseursRepository;
use App\Repository\RegelementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SituationFrsController extends AbstractController
{
    /**
     * @Route("/situation/frs/{id}", name="situation_frs")
     */
    public function index($id,FournisseursRepository $repoFrs,RegelementRepository $repoRegele)
    {
        $fournisseur = $repoFrs->findBy(['id' => $id]);
        $regelement = $repoRegele->findBy(['id' => $id]);
        return $this->render('Admin/fournisseurs/SituationFournisseur.html.twig', [
           'fournisseurs' => $fournisseur,
           'regelements' => $regelement
        ]);
    }
}
