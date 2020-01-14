<?php

namespace App\Controller;

use App\Repository\ContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminContactController extends AbstractController
{
    /**
     * @Route("/admin/contact", name="AdminContact")
     */
    public function index(ContactRepository $cont)
    {
        $contact = $cont->findAll();
        return $this->render('admin/contact/index.html.twig', [
           'contacts' => $contact
        ]);
    }
}
