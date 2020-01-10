<?php

namespace App\Controller;

use App\Repository\TypesRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AppController extends AbstractController
{
    /**
     * @Route("/", name="homePage")
     */
    public function index(TypesRepository $typeCa)
    {
       $type = $typeCa->findAll();
        return $this->render('pages/home.html.twig',[
            'typee' => $type
        ]);
    }

    /**
     * @Route("/presentation", name="presentationPage")
     */
    public function presentation(TypesRepository $typeCa)
    {
        $type = $typeCa->findAll();
        return $this->render('pages/presentation.html.twig',[
            'typee' => $type
        ]);
    }
}
