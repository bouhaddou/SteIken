<?php

namespace App\Controller;

use App\Repository\TypesRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contactPage")
     */
    public function index(TypesRepository $typeCa)
    {
       $type = $typeCa->findAll();
        return $this->render('contact/index.html.twig',[
            'typee' => $type
        ]
        );
    }
}
