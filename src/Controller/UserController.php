<?php

namespace App\Controller;
use App\Entity\Users;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Partie;
use App\Form\UserEmail;
use App\Form\UserMdp;
use App\Form\UserPseudo;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Form\UserType;

class UserController extends Controller
{
    /**
     * @Route("/profil", name="player")
     */
    public function player()
    {
        $player = $this->get('security.token_storage')->getToken()->getUser();
        $etat = $player->getBloque();
        if($etat == 0){
            //retourne la page profil avec ses infos et statistique
            $victoire =$player->getVictoire();
            $defaite =$player->getDefaite();
            $somme_parties = $victoire+$defaite;
            if($somme_parties !=0){
                $pourcentage = round((100*$victoire)/$somme_parties).'%';
            }else{
                $pourcentage = 'Aucune partie n\'a été jouée ';
            }
            //retrouver la partie en cours et le joueur adverse
            $id_partie = $player->getPartieCours();
            if( $id_partie != 0){
                $partie = $this->getDoctrine()->getRepository(Partie::class)->find($id_partie);
                $j1 = $partie->getIdJ1();
                $j2 = $partie->getIdJ2();
                if($player->getId() == $j1->getId()){
                    $ja = $j2;
                }elseif($player->getId() == $j2->getId()){
                    $ja = $j1;
                }else{
                    $ja= "" ;
                }
            }else{
                $partie = "";
                $ja = "";
            }
            return $this->render('User/player.html.twig',['joueur'=>$player, 'ratio'=>$pourcentage, 'nbpartie'=>$somme_parties,'partie'=>$partie, 'ja'=>$ja]);
        }else{
            return $this->render('User/bloque.html.twig');
        }
    }
    /**
     * @Route("/classement", name="classement")
     */
    public function classement(){
        if($this->container->get('security.authorization_checker')->isGranted('ROLE_USER') || $this->container->get('security.authorization_checker')->isGranted('ROLE_ADMIN')){
            $joueurs = $this->getDoctrine()->getRepository(Users::class)->findByRole('ROLE_USER');
            $tjoueurs = array();
            foreach ($joueurs as $player){
                //recup pourcentage de victoire
                $victoire =$player->getVictoire();
                $defaite =$player->getDefaite();
                $somme_parties = $victoire+$defaite;
                if($somme_parties !=0){
                    $pourcentage = round((100*$victoire)/$somme_parties).'%';
                }else{
                    $pourcentage = 0 ;
                }
                $nom = $player->getUsername();
                $tjoueurs[] = ['ratio'=>$pourcentage, 'nom'=>$nom, 'nb'=>$somme_parties];
            }
            arsort($tjoueurs);
            return $this->render('User/classement.html.twig', ['joueurs' => $tjoueurs]);
        }else{
            return $this->redirectToRoute('index');
        }
    }
    /**
     * @Route("/changer_infos", name="changer_infos")
     */
    public function change_infos(){
        if($this->container->get('security.authorization_checker')->isGranted('ROLE_USER')){
            return $this->render('User/changer_infos.html.twig');
        }else{
            return $this->redirectToRoute('index');
        }
    }
    /**
     * @Route("/changer_pseudo", name="changer_pseudo")
     */
    public function changer_pseudo(Request $request){
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $form = $this->createForm(UserPseudo::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user->getUsername();
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return $this->render(
                'User/changer_infos.html.twig',
                array('message' => 'Votre pseudo a bien été mis à jour')
            );
        }
        return $this->render(
            'User/changer_infos.html.twig',
            array('form_pseudo' => $form->createView())
        );
    }
    /**
     * @Route("/changer_email", name="changer_email")
     */
    public function changer_email(Request $request){
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $form = $this->createForm(UserEmail::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return $this->render(
                'User/changer_infos.html.twig',
                array('message' => 'Votre email a bien été mis à jour')
            );
        }
        return $this->render(
            'User/changer_infos.html.twig',
            array('form_email' => $form->createView())
        );
    }
    /**
     * @Route("/changer_mdp", name="changer_mdp")
     */
    public function changer_mdp(Request $request, UserPasswordEncoderInterface $passwordEncoder){
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $form = $this->createForm(UserMdp::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $password = $passwordEncoder->encodePassword($user, $user->getPassword());
            $user->setPassword($password);
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return $this->render(
                'User/changer_infos.html.twig',
                array('message' => 'Votre mot de passe a bien été mis à jour')
            );
        }
        return $this->render(
            'User/changer_infos.html.twig',
            array('form_mdp' => $form->createView())
        );
    }
}?>