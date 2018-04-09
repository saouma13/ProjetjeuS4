<?php

// src/Controller/Accueil.php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AccueilController extends Controller
{
        /**
            * @Route("/", name="app_accueil")
        */

        public function index()
        {
            return $this->render('accueil.html.twig');


        }
        /**
        * @Route("/user", name="user")
        */
        public function users()
        {
            if($this->container->get('security.authorization_checker')->isGranted('ROLE_ADMIN')){
                return $this->redirectToRoute('admin');
            }else{
                return $this->redirectToRoute('player');
        }
    }

}