<?php
// src/Controller/PartieController.php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PartieController extends Controller
{
    /**
     * @Route("/mes-parties", name="mesParties")
     */
    public function mon_profil()
    {

        return $this->render('Partie/mesParties.html.twig');
    }

    /**
     * @Route("/nouvelle", name="nouvellePartie")
     */
    public function nouvellePartie()
    {

        return $this->render('Partie/nouvellePartie.html.twig');
    }
}

?>