<?php

namespace App\Controller;

use App\Repository\TypesRepository;
use App\Repository\ProduitsRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MetalliqueController extends AbstractController
{
    /**
     * @Route("/metallique", name="metalliquePage")
     */
    public function index(TypesRepository $typeCa)
    {
       $type = $typeCa->findBy(['Categories' => "3" ]);
       $typee = $typeCa->findAll();
        return $this->render('metallique/index.html.twig',[
            'types' => $type,
            'typee' => $typee
        ]);
    }

    
}
