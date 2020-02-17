<?php

namespace App\Controller;

use App\Entity\AchatReg;
use App\Entity\ClientsPar;
use App\Entity\Fournisseurs;
use App\Entity\ClientsVentes;
use App\Repository\AchatRegRepository;
use App\Repository\ClientsParRepository;
use App\Repository\FournisseursRepository;
use App\Repository\ClientsVentesRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

    /**
     * @Route("/admin/situation")
     */
class SituationController extends AbstractController
{
   
    /**
     * @Route("/{id}/fournisseur", name="situation_frs")
     */
    public function index(AchatRegRepository $achatReg,$id,FournisseursRepository $repofrs)
    {
        $frs = $repofrs->findOneBy(['id' => $id]);
        $result = $achatReg->findByAchatReg($frs);
        return $this->render('admin/situationfrs/index.html.twig', [
            'achatRegs' => $result,
            'nom' => $frs->getNomComplet()
        ]);
    }

    /**
     * @Route("/All/fournisseurs", name="situation_frsAll")
     */
    public function AllAchat(FournisseursRepository $repo)
    {
      
        return $this->render('admin/situationfrs/situationAll.html.twig', [
            'frs' => $repo->findAll(),
        ]);
    }

    /**
     * @Route("/{id}/client", name="situation_clt")
     */
    public function indexcli(ClientsVentesRepository $achatReg,$id,ClientsParRepository $repofrs)
    {
        $frs = $repofrs->findOneBy(['id' => $id]);
        $result = $achatReg->findByventes($frs);
        return $this->render('admin/situationcli/index.html.twig', [
            'clients' => $result,
        ]);
    }

    /**
     * @Route("/All/clients", name="situation_cltAll")
     */
    public function AllVente(ClientsVentesRepository $achatReg)
    {
       
        return $this->render('admin/situationcli/index.html.twig', [
            'clients' => $achatReg->findAll(),
        ]);
    }
}
