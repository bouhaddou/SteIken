<?php

namespace App\Controller;

use App\Entity\Produits;
use App\Form\Type;
use App\Entity\Types;
use App\Form\EditProduitType;
use App\Form\ProduitType;
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
            $cc = (int) $cat->getId();
            return $this->redirectToRoute('categoriePageBois',array( 'id' => $cc)); 
        }
        return $this->render('admin/site/AddType.html.twig', [
           'form' => $form->createView(),
            'categories' => $cat
        ]);
    }



    /**
     * @Route("/admin/Article/Edit/{id}", name="ArticlesPageEdit")
     */
    public function indexArticleEdit(Request $request,$id,CategorieRepository $cate, Types $type)
    {
        $form = $this->createForm(Type::class,$type);
        $cat = $cate->findOneBy(['id' => $type->getCategories()->getId() ]);
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
           'form' => $form->createView(),
            'categories' => $cat
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

    /**
     * @Route("/admin/produits/{id}", name="ProduitsPage")
     */
    public function indexProduits($id,CategorieRepository $cate,ProduitsRepository $pro)
    {
        $cat = $cate->findOneBy(['id' => $id ]);
        $produit = $pro->findNextChrono($cat);
        
        return $this->render('admin/site/AdminProduit.html.twig', [
            'produits' => $produit,
            'categorie' => $cat
        ]);
    }


    /**
     * @Route("/admin/produit/new/{id} ", name="produitPageNew")
     */
    public function indexProduitNew(Request $request,$id,TypesRepository $repo)
    {
        $type = $repo->findOneBy(['id' => $id ]);
        $produit = new Produits();
        $form = $this->createForm(ProduitType::class,$produit);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $file=  $form->get('image')->getData();
            $filename=md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('upload_directory'),$filename);
            $produit->setImage($filename);
            $manager = $this->getDoctrine()->getManager();
            $produit->setType($type);
            $manager->persist($produit);
            $manager->flush();
            $cc = (int) $type->getCategories()->getId();
          return  $this->redirectToRoute('categoriePageBois',['id' => $cc]); 
        }        
        return $this->render('admin/site/AddProduit.html.twig', [
           'form' => $form->createView(),
           'types' => $type
        ]);
    }

    /**
     * @Route("/admin/produit/{id}?{cat}", name="ProduitsPage2")
     */
    public function indexProduits2($id,ProduitsRepository $pro,CategorieRepository $cate, $cat)
    {
        $produit = $pro->findBy(['type' => $id ]);
        $cat = $cate->findOneBy(['id' => $cat ]);
        return $this->render('admin/site/AdminProduit.html.twig', [
            'produits' => $produit,
            'categorie' => $cat
        ]);
    }

    /**
     * @Route("/admin/produit/{id}/delete", name="deleteProduitPage")
     */
    public function deletProduit(ProduitsRepository $repo , $id)
    {
     
    $result = $repo->findOneById($id);
    $em= $this->getDoctrine()->getManager();
        $em->remove($result);
        $em->flush();
        return $this->redirectToRoute('categoriePage'); 
    }

     /**
     * @Route("/admin/produit/Edit/{id}", name="ProduitPageEdit")
     */
    public function indexProduitEdit(Request $request,$id,ProduitsRepository $repo)
    {
        $prod = $repo->findOneById($id);
        $form = $this->createForm(EditProduitType::class,$prod);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $file=  $form->get('image')->getData();
            $filename=md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('upload_directory'),$filename);
            $prod->setImage($filename);
            $manager = $this->getDoctrine()->getManager();
            $prod->setType($prod->getType());
           
            $manager->persist($prod);
            $manager->flush();
            $cc = (int)$prod->gettype()->getId();
            $ccd= (int) $prod->gettype()->getCategories()->getId();
           return $this->redirectToRoute('ProduitsPage2',array( 'id' => $cc, 'cat' => $ccd)); 
        }        
        return $this->render('admin/site/EditProduit.html.twig', [
           'form' => $form->createView(),
           'produits' => $prod
        ]);
    }
}
