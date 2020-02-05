<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminAcountController extends AbstractController
{

    private $encoder;
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    /**
     * @Route("/admin/login", name="admin_login")
     */
    public function login(AuthenticationUtils $utils)
    {
        $error = $utils->getLastAuthenticationError();
        $username = $utils->getLastUsername();

        return $this->render('admin/account/login.html.twig', [
            'hasError' => $error !== null,
            'username' => $username
        ]);
    }

    /**
     * @Route("/admin/logout", name="admin_logout")
     */
    public function logout()
    {
        
    }

    /**
     * @Route("/admin/register", name="account_register")
     */
    public function register(Request $request)
    {
        $user = new User();
         $form = $this->createForm(RegisterType::class,$user);
         $form->handleRequest($request);

         if($form->isSubmitted() && $form->isValid())
         {
             $em = $this->getDoctrine()->getManager();
             $pass=$this->encoder->encodePassword($user,$user->getPassword());
             $user->setPassword($pass);
             $em->persist($user);
             $em->flush();
             return $this->redirectToRoute('admin_login');
         }
        return $this->render('admin/account/register.html.twig',[
            'form' => $form->createView()
        ]);
    }
}
