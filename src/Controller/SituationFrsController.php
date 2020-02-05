<?php

namespace App\Controller;

use App\Entity\Fournisseurs;
use App\Repository\AchatRegRepository;
use App\Repository\FournisseursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

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
            'achatRegs' => $result
        ]);
    }
}
