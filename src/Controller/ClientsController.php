<?php

namespace App\Controller;

use App\Entity\Avenant;
use App\Entity\Clients;
use App\Entity\Decomptes;
use App\Form\AvenantsType;
use App\Form\ClientsType;
use App\Form\DecomptesType;
use App\Form\EditAvenantType;
use App\Form\EditDecomptesType;
use App\Repository\ClientsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ClientsController extends AbstractController
{
    /**
     * @Route("/clients", name="clientsPage")
     */
    public function index(ClientsRepository $client)
    {
        $clients = $client->findAll();
        return $this->render('Admin/clients/index.html.twig', [
           'clients' => $clients
        ]);
    }
    // --------------------------------------------------------------------Ajouter Clients
    /**
     * @Route("/clients/new", name="clientsNewPage")
     */
    public function AddClient(Request $request)
    {
        $Client = new Clients();
        $form = $this->createForm(ClientsType::class,$Client);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $manager = $this->getDoctrine()->getManager();
            $type = $request->get('typeClient');
            $Client->setTypeClient($type);
            $manager->persist($Client);
            $manager->flush();
            return $this->redirectToRoute('clientsPage');
        }
        return $this->render('Admin/clients/AdClients.html.twig', [
           'form' => $form->createView(),
        ]);
    }

    // --------------------------------------------------------------------Modifier Clients
    /**
     * @Route("/clients/{id}/Edit", name="clientsEditPage")
     */
    public function EditClient(Request $request,Clients $Client)
    {
        $form = $this->createForm(ClientsType::class,$Client);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($Client);
            $manager->flush();
            return $this->redirectToRoute('clientsPage');
        }
        return $this->render('Admin/clients/EditClient.html.twig', [
           'form' => $form->createView(),
        ]);
    }

    //---------------------------------------------------------------------Show Clients
    /**
     * @Route("/clients/{id}/Show", name="clientsShowPage")
     */
    public function ShowClient(ClientsRepository $client,$id)
    {
        $clients = $client->findOneBy(['id' => $id]);
        return $this->render('Admin/clients/Show.html.twig', [
           'clients' => $clients
        ]);
    }
    //---------------------------------------------------------------------Ajouter Decomptes
    /**
     * @Route("/decompte/{id}/new", name="DecompteNewPage")
     */
    public function NewDecompte(ClientsRepository $client,$id,Request $request)
    {
        $decompte =new Decomptes();
        $clients = $client->findOneBy(['id' => $id]);
        $form = $this->createForm(DecomptesType::class,$decompte);
        $form->handleRequest($request);
        if(  $form->isSubmitted() && $form->isValid())
        {
            $manager = $this->getDoctrine()->getManager();
            $decompte->setClient($clients);
            $manager->persist($decompte);
            $manager->flush();
           
           return $this->redirectToRoute('clientsShowPage',['id' => $clients->getId()]);
        }
        return $this->render('Admin/clients/AdDecompte.html.twig', [
           'clients' => $clients,
           'form' => $form->createView()
        ]);
    }

     //---------------------------------------------------------------------Modifier Decomptes
    /**
     * @Route("/decompte/{id}/Edit", name="DecompteEditPage")
     */
    public function EditDecompte(ClientsRepository $client,$id,Request $request, Decomptes $decompte)
    {
        $form = $this->createForm(EditDecomptesType::class,$decompte);
        $form->handleRequest($request);
        if(  $form->isSubmitted() && $form->isValid())
        {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($decompte);
            $manager->flush();
           
           return $this->redirectToRoute('clientsShowPage',['id' => $decompte->getClient()->getId()]);
        }
        return $this->render('Admin/clients/EditDecompte.html.twig', [
           'form' => $form->createView()
        ]);
    }

     //---------------------------------------------------------------------Modifier Avenant
    /**
     * @Route("/Avenant/{id}/Edit", name="AvenantEditPage")
     */
    public function EditAvenant(ClientsRepository $client,$id,Request $request, Avenant $avenant)
    {
        $form = $this->createForm(EditAvenantType::class,$avenant);
        $form->handleRequest($request);
        if(  $form->isSubmitted() && $form->isValid())
        {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($avenant);
            $manager->flush();
           
           return $this->redirectToRoute('clientsShowPage',['id' => $avenant->getClient()->getId()]);
        }
        return $this->render('Admin/clients/EditAvenant.html.twig', [
           'form' => $form->createView()
        ]);
    }

    //---------------------------------------------------------------------Ajouter Decomptes
    /**
     * @Route("/Avenant/{id}/new", name="AvenantNewPage")
     */
    public function NewAvenant(ClientsRepository $client,$id,Request $request)
    {
        $Avenant =new Avenant();
        $clients = $client->findOneBy(['id' => $id]);
        $form = $this->createForm(AvenantsType::class,$Avenant);
        $form->handleRequest($request);
        if(  $form->isSubmitted() && $form->isValid())
        {
            $manager = $this->getDoctrine()->getManager();
            $Avenant->setClient($clients);
            $manager->persist($Avenant);
            $manager->flush();
           
           return $this->redirectToRoute('clientsShowPage',['id' => $clients->getId()]);
        }
        return $this->render('Admin/clients/AdDecompte.html.twig', [
           'clients' => $clients,
           'form' => $form->createView()
        ]);
    }
}
