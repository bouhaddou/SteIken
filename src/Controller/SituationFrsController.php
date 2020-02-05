<?php

namespace App\Controller;

use App\Entity\AchatReg;
use App\Entity\Fournisseurs;
use App\Repository\AchatRegRepository;
use App\Repository\FournisseursRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

    /**
     * @Route("/admin/situation")
     */
class SituationFrsController extends AbstractController
{
   
    /**
     * @Route("/{id}", name="situation_frs")
     */
    public function index(AchatRegRepository $achatReg,$id,FournisseursRepository $repofrs)
    {
        $frs = $repofrs->findOneBy(['id' => $id]);
        $result = $achatReg->findByAchatReg($frs);
        return $this->render('admin/situationfrs/index.html.twig', [
            'achatRegs' => $result,
        ]);
    }

    /**
     * @Route("/All/FRS", name="situation_frsAll")
     */
    public function AllAchat(AchatRegRepository $achatReg)
    {
       
        return $this->render('admin/situationfrs/index.html.twig', [
            'achatRegs' => $achatReg->findAll(),
        ]);
    }
}
