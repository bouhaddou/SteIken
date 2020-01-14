<?php

namespace App\Controller;

use App\Entity\Finition;
use App\Entity\FinitionDetails;
use App\Form\DetailsFinitionType;
use App\Form\FinitionType;
use App\Repository\FinitionDetailsRepository;
use App\Repository\FinitionRepository;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminFinitionController extends AbstractController
{
    /**
     * @Route("/finition", name="finitionPage")
     */
    public function index(FinitionRepository $repo)
    {
        $finition = $repo->findAll();
        return $this->render('Admin/finition/index.html.twig',[
            'finitions' => $finition
        ]);
    }

    /**
     * @Route("/finition/new", name="finitionNewPage")
     */
    public function indexNew(Request $request)
    {
        $finition = new Finition();
        $form = $this->createForm(FinitionType::class,$finition);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($finition);
            $manager->flush();
            return $this->redirectToRoute('finitionPage');
        }
        return $this->render('Admin/finition/AddFinition.html.twig',[
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/finition/Edit/{id}", name="finitionEditPage")
     */
    public function indexEdit(Request $request,Finition $finition)
    {
        $form = $this->createForm(FinitionType::class,$finition);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($finition);
            $manager->flush();
            return $this->redirectToRoute('finitionPage');
        }
        return $this->render('Admin/finition/AddFinition.html.twig',[
            'form' => $form->createView()
        ]);
    }

     /**
     * @Route("/admin/Finition/{id}/delete", name="deleteFinitionPage")
     */
    public function deletFinition(FinitionRepository $repo , $id)
    {
     
    $result = $repo->findOneById($id);
    $em= $this->getDoctrine()->getManager();
        $em->remove($result);
        $em->flush();
        return $this->redirectToRoute('finitionPage'); 
    }
    //--------------------------------------------------------------------------------------------

    

    /**
     * @Route("/finition/details/{id}", name="DetailsFinition")
     */
    public function indexDetails(FinitionDetailsRepository $repo,$id, FinitionRepository $fini)
    {
        $finition = $fini->findOneBy(['id' => $id ]);
        $fini = $repo->findFinition($finition);
        return $this->render('Admin/finition/DetailsFinition.html.twig',[
            'finitions' => $fini,
            'id' => $id
        ]);
    }


    /**
     * @Route("/finition/Details/new/{id}", name="finitionDetailsNewPage")
     */
    public function indexDeatailsNew(Request $request,$id,FinitionRepository $repo)
    {
        $finition = new FinitionDetails();
        $fini = $repo->findOneBy(['id' => $id ]);
        $form = $this->createForm(DetailsFinitionType::class,$finition);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $file=  $form->get('image')->getData();
           
            $filename=md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('upload_directory'),$filename);
            $finition->setImage($filename);
            $manager = $this->getDoctrine()->getManager();

            $finition->setFinitions($fini);
            $manager->persist($finition);
            $manager->flush();
            return $this->redirectToRoute('finitionPage');
        }
        return $this->render('Admin/finition/AddFinitionDeatails.html.twig',[
            'form' => $form->createView()
        ]);
    }

    
    /**
     * @Route("/finition/Details/Edit/{id}", name="finitionEditDetailsPage")
     */
    public function indexFinitionDetailsEdit(Request $request,FinitionDetailsRepository $repo,$id)
    {
        $fini = $repo->findOneBy(['id' => $id ]);
        $finition = $fini->getFinitions();
       
        $form = $this->createForm(DetailsFinitionType::class,$fini);
        
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        { 
            $file=  $form->get('image')->getData();
            $filename=md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('upload_directory'),$filename);
            $fini->setImage($filename);
            $manager = $this->getDoctrine()->getManager();

            $fini->setFinitions($finition);
            $manager->persist($fini);
            $manager->flush();
            return $this->redirectToRoute('finitionPage');
        }
        return $this->render('Admin/finition/AddFinition.html.twig',[
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/Finition/details/{id}/delete", name="deleteFinitionDetailsPage")
     */
    public function deletFinitionDetails(FinitionDetailsRepository $repo , $id)
    {
    $result = $repo->findOneById($id);
    $em= $this->getDoctrine()->getManager();
        $em->remove($result);
        $em->flush();
        $cc= (int) $result->getFinitions()->getId();
        return $this->redirectToRoute('DetailsFinition',['id' => $cc]); 
    }
}
