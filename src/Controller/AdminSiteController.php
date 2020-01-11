<?php

namespace App\Controller;

use App\Form\Type;
use App\Entity\Types;
use App\Repository\TypesRepository;
use App\Repository\ProduitsRepository;
use App\Repository\CategorieRepository;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminSiteController extends AbstractController
{
    /**
     * @Route("/admin/categorie", name="categoriePage")
     */
    public function index()
    {
        return $this->render('admin/site/categorie.html.twig', [
            
        ]);
    }
    
    /**
     * @Route("/admin/categorie/{id}", name="categoriePageBois")
     */
    public function indexBois($id,TypesRepository $type,CategorieRepository $cate)
    {
        $types = $type->findBy(['Categories' => $id ]);
        $cat = $cate->findOneBy(['id' => $id ]);
        return $this->render('admin/site/AdminBois.html.twig', [
            'types' => $types,
            'categorie' => $cat
        ]);
    }

    /**
     * @Route("/admin/produit/{id}", name="ProduitsPage")
     */
    public function indexProduits($id,CategorieRepository $cate,ProduitsRepository $pro)
    {
        $cat = $cate->findOneBy(['id' => $id ]);
        $produit = $pro->findNextChrono($cat);
        
        return $this->render('admin/site/AdminProduit.html.twig', [
            'types' => $produit,
            'categorie' => $cat
        ]);
    }

    /**
     * @Route("/admin/Article/new/{id} ", name="ArticlesPage")
     */
    public function indexArticle(Request $request,$id,CategorieRepository $cate)
    {
        $type = new Types();
        $cat = $cate->findOneBy(['id' => $id ]);
        $form = $this->createForm(Type::class,$type);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $manager = $this->getDoctrine()->getManager();
            $type->setCategories($cat);
            $manager->persist($type);
            $manager->flush();
          return  $this->redirectToRoute('categoriePageBois',['id' => $cat->getId()]); 
        }        
        return $this->render('admin/site/AddType.html.twig', [
           'form' => $form->createView()
        ]);
    }

      /**
     * @Route("/admin/Article/Edit/{id}", name="ArticlesPageEdit")
     */
    public function indexArticleEdit(Request $request,$id,CategorieRepository $cate, Types $type)
    {
        $form = $this->createForm(Type::class,$type);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
           
            $manager = $this->getDoctrine()->getManager();
            $type->setCategories($type->getCategories()); 
            $manager->persist($type);
            $manager->flush();
            $cc = $type->getCategories()->getId();
           return $this->redirectToRoute('categoriePageBois',array( 'id' => $cc)); 
        }        
        return $this->render('admin/site/AddType.html.twig', [
           'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/{id}/delete", name="deleteTypePage")
     */
    public function deletepost(Request $request,TypesRepository $repo , $id)
    {
     
    $result = $repo->findOneById($id);
    $em= $this->getDoctrine()->getManager();
        $em->remove($result);
        $em->flush();
        $cc= $result->getCategories()->getId();
        return $this->redirectToRoute('categoriePageBois',array( 'id' => $cc)); 
    }
    
}
