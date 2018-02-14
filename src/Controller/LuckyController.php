<?php
// src/Controller/LuckyController.php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LuckyController extends Controller
{
    /**
     * @Route("/lucky/number", name="app_lucky_number")
     */
    public function number()
    {
        
        return $this->render('lucky/number.html.twig');
    }
    /**
     * @Route("/lucky/page", name="app_lucky_page")
     */
    public function page()
    {
        
        return $this->render('lucky/page.html.twig');
    }
}

?>