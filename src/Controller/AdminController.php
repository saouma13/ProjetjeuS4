<?php
namespace App\Controller;
use App\Entity\Users;
use App\Entity\Partie;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
class AdminController extends Controller
{
    /**
     * @Route("/admin", name="admin")
     */
    public function admin()
    {
        //retourne tous les joueurs et leurs infos
        $utilisateurs = $this->getDoctrine()->getRepository(Users::class)->findAll();
        $joueur = array();
        foreach ($utilisateurs as $player){
            if($player->getRoles() != ["ROLE_ADMIN"]){
                //recup pourcentage de victoire
                $victoire =$player->getVictoire();
                $defaite =$player->getDefaite();
                $somme_parties = $victoire+$defaite;
                if($somme_parties !=0){
                    $pourcentage = round((100*$victoire)/$somme_parties).'%';
                }else{
                    $pourcentage = 'Aucune partie n\'a été jouée ';
                }
                $joueur[] = array('joueur'=>$player, 'ratio'=>$pourcentage ,'nbpartie'=>$somme_parties);
            }
        }
        return $this->render('User/admin.html.twig',['joueurs' => $joueur]);
    }
    /**
     * @Route("/changer_etat", name="changer_etat")
     */
    public function changer_etat(Request $request)
    {
        if($this->container->get('security.authorization_checker')->isGranted('ROLE_ADMIN')){
            $id = $request->request->get('bloque');
            $user = $this->getDoctrine()->getRepository(Users::class)->find($id);
            $etat = $user->getBloque();
            if($etat == 0){
                $etat = 1;
            }else{
                $etat=0;
            }
            $user->setBloque($etat);
            $id_partie = $user->getPartieCours();
            $partie = $this->getDoctrine()->getRepository(Partie::class)->find($id_partie);
            if($id_partie != 0 ){
                $j1 = $partie->getJ1();
                $j2 = $partie->getJ2();
                $j2->setPartieCours(0);
                $j1->setPartieCours(0);
                if($user->getId() == $j1->getId()){
                   $partie->setVainqueur('j2');
                   $v = $j2->getVictoire();
                   $v = $v+1;
                   $j2->setVictoire($v);
                }else{
                    $partie->setVainqueur('j1');
                    $v = $j->getVictoire();
                    $v = $v+1;
                    $j1->setVictoire($v);
                }
                $em = $this->getDoctrine()->getManager();
                $em->persist($partie);
            }
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('admin');
        }else{
            return $this->redirectToRoute('index');
        }
    }
}