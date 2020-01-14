<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\TypesRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contactPage")
     */
    public function index(TypesRepository $typeCa,Request $request)
    {
       $type = $typeCa->findAll();
       $contact = new Contact();
       $form = $this->createForm(ContactType::class,$contact);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $manager= $this->getDoctrine()->getManager();
            $manager->persist($contact);
            $manager->flush();
        }
        return $this->render('contact/index.html.twig',[
            'typee' => $type,
            'form' => $form->createView()
        ]
        );
    }
}
