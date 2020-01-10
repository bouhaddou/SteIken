<?php

namespace App\Controller;

use App\Repository\ProduitsRepository;
use App\Repository\TypesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BoisController extends AbstractController
{
    /**
     * @Route("/bois", name="boisPage")
     */
    public function index(TypesRepository $typeCa)
    {
       $type = $typeCa->findBy(['Categories' => "2" ]);
       $typee = $typeCa->findAll();
        return $this->render('bois/index.html.twig',[
            'types' => $type,
            'typee' => $typee
        ]);
    }

    /**
     * @Route("/boisDetails/{id}", name="boisDetails")
     * 
     */
    public function boisDetailss(ProduitsRepository $prod ,$id,TypesRepository $typeCa)
    {

       $produi = $prod->findOneBy(['id' => $id ]);
       $type = $typeCa->findAll();
        return $this->render('bois/produitDetails.html.twig',[
           'produits' => $produi,
           'typee' => $type
        ]);
    }
}
