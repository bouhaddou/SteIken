<?php

namespace App\Controller;

use App\Repository\TypesRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

    /**
     * @Route("/admin")
     */
class AdminController extends AbstractController
{
    /**
     * @Route("/", name="adminPage")
     */
    public function index(TypesRepository $typeCa)
    {
       $type = $typeCa->findAll();
        return $this->render('admin/dashbord/dashboard.html.twig', [
            'typee' => $type
        ]);
    }
}
