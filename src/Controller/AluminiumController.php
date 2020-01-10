<?php

namespace App\Controller;

use App\Repository\TypesRepository;
use App\Repository\ProduitsRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AluminiumController extends AbstractController
{
    /**
     * @Route("/aluminium", name="aluminiumPage")
     */
    public function index(TypesRepository $typeCa)
    {
       $type = $typeCa->findBy(['Categories' => "1" ]);
       $typee = $typeCa->findAll();
        return $this->render('aluminium/index.html.twig',[
            'types' => $type,
            'typee' => $typee
        ]);
    }

    
      
           
}
