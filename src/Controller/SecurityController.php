<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\RegistrationType;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class SecurityController extends AbstractController
{
    /**
     * @Route("/inscription", name="security_registration")
     */

    
    public function register(Request $request,ObjectManager $manager,UserPasswordEncoderInterface $encoder)
    {
        $user =new User();
        $form = $this->createForm(RegistrationType::class,$user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $hash = $encoder->encodePassword($user,$user->getPassword());
            $user->setPassword($hash);
            $manager->persist($user);
            $manager->flush();
            return  $this->redirectToRoute('security_login');
        }
        return $this->render('security/index.html.twig', [
            'controller_name' => 'SecurityController',
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/login", name="security_login")
     */
    public function login (Request $request)
    {
        return $this->render('security/login.html.twig');

    }

     /**
     * @Route("/deconnexion", name="security_logout")
     */
    public function logout ()
    {

    }
}
