<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminAchatRegController extends AbstractController
{
    /**
     * @Route("/admin/achat/reg", name="admin_achat_reg")
     */
    public function index()
    {
        return $this->render('admin_achat_reg/index.html.twig', [
            'controller_name' => 'AdminAchatRegController',
        ]);
    }
}
