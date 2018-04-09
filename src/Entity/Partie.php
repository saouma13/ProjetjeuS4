<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PartieRepository")
 */
class Partie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="datetime", name = "date_debut",nullable=true)
     */
/**
* @var \DateTime
*
* @ORM\Column(name="created_at", type="datetime")
*/
    private $createdAt;

    public function __construct()
    {
        $this->createdAt = new \Datetime('Europe/Paris');
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }
    /**
     * @ORM\Column(type="text", name = "main_joueur1",nullable=true)
     */
    private $main_j1;
    /**
     * @ORM\Column(type="text", name = "main_joueur2",nullable=true)
     */
    private $main_j2;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Users")
     * */
    private $id_j1;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Users")
     */
    private $id_j2;
    /**
     * @ORM\Column(type="integer", name = "score_joueur1",nullable=true)
     */
    private $score_j1;
    /**
     * @ORM\Column(type="integer", name = "score_joueur2",nullable=true)
     */
    private $score_j2;
    /**
     * @ORM\Column(type="string", name = "tour_joueur",nullable=true)
     */
    private $tour;

    // add your own fields
    /**
     * @ORM\Column(type="integer", name = "manche",nullable=true)
     */
    private $manche;
    /**
     * @ORM\Column(type="text", name = "pioche",nullable=true)
     */
    private $pioche;
    /**
     * @ORM\Column(type="text", name = "objectif",nullable=true)
     */
    private $objectif;
    /**
     * @ORM\Column(type="text")
     */
    private $action_j1;

    /**
     * @var
     * @ORM\Column(type="text")
     */
    private $action_j2;
    /**
     * @ORM\Column(type="string")
     */
    private $vainqueur;

    /**
     * @ORM\Column(type="string", name = "terrainJ1",nullable=true)
     */
    private $terrainJ1;
    /**
     * @ORM\Column(type="string", name = "terrainJ2",nullable=true)
     */
    private $terrainJ2;
    /**
     * @ORM\Column(type="string", name = "carteecarte",nullable=true)
     */
    private $carteecarte;
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    /**
     * @return mixed
     */
    public function getMainJ1()
    {
        return json_decode($this->main_j1, true);
    }

    /**
     * @param mixed $main_j1
     */
    public function setMainJ1($main_j1)
    {
        $this->main_j1 = json_encode($main_j1);
    }

    /**
     * @return mixed
     */
    public function getMainJ2()
    {
        return json_decode($this->main_j2, true);
    }

    /**
     * @param mixed $main_j2
     */
    public function setMainJ2($main_j2)
    {
        $this->main_j2 = json_encode($main_j2);
    }

    /**
     * @return mixed
     */
    public function getIdJ1()
    {
        return $this->id_j1;
    }

    /**
     * @param mixed $id_j1
     */
    public function setIdJ1($id_j1)
    {
        $this->id_j1 = $id_j1;
    }

    /**
     * @return mixed
     */
    public function getIdJ2()
    {
        return $this->id_j2;
    }

    /**
     * @param mixed $id_j2
     */
    public function setIdJ2($id_j2)
    {
        $this->id_j2 = $id_j2;
    }

    /**
     * @return mixed
     */
    public function getScoreJ1()
    {
        return $this->score_j1;
    }

    /**
     * @param mixed $score_j1
     */
    public function setScoreJ1($score_j1)
    {
        $this->score_j1 = $score_j1;
    }

    /**
     * @return mixed
     */
    public function getScoreJ2()
    {
        return $this->score_j2;
    }

    /**
     * @param mixed $score_j2
     */
    public function setScoreJ2($score_j2)
    {
        $this->score_j2 = $score_j2;
    }

    /**
     * @return mixed
     */
    public function getTour()
    {
        return $this->tour;
    }

    /**
     * @param mixed $tour
     */
    public function setTour($tour)
    {
        $this->tour = $tour;
    }

    /**
     * @return mixed
     */
    public function getManche()
    {
        return $this->manche;
    }

    /**
     * @param mixed $manche
     */
    public function setManche($manche)
    {
        $this->manche = $manche;
    }

    /**
     * @return mixed
     */
    public function getPioche()
    {
        return json_decode($this->pioche, true);
    }

    /**
     * @param mixed $pioche
     */
    public function setPioche($pioche)
    {
        $this->pioche =json_encode($pioche);
    }

    /**
     * @return mixed
     */
    public function getObjectif()
    {
        return json_decode($this->objectif, true);
    }

    /**
     * @param mixed $objectif
     */
    public function setObjectif($objectif)
    {
        $this->objectif = json_encode($objectif);
    }

    /**
     * @return mixed
     */
    public function getActionJ1()
    {
        return json_decode($this->action_j1,true);
    }

    /**
     * @param mixed $action_j1
     */
    public function setActionJ1($action_j1)
    {
        $this->action_j1 = json_encode($action_j1);
    }

    /**
     * @return mixed
     */
    public function getActionJ2()
    {
        return json_decode($this->action_j2,true);
    }

    /**
     * @param mixed $action_j2
     */
    public function setActionJ2($action_j2)
    {
        $this->action_j2 = json_encode($action_j2);
    }

    /**
     * @return mixed
     */
    public function getTerrain()
    {
        return $this->terrain;
    }

    /**
     * @param mixed $terrain
     */
    public function setTerrain($terrain)
    {
        $this->terrain = $terrain;
    }

    /**
     * @return mixed
     */
    public function getCarteecarte()
    {
        return $this->carteecarte;
    }

    /**
     * @param mixed $carteecarte
     */
    public function setCarteecarte($carteecarte)
    {
        $this->carteecarte = $carteecarte;
    }

    /**
     * @return mixed
     */
    public function getVainqueur()
    {
        return $this->vainqueur;
    }

    /**
     * @param mixed $vainqueur
     */
    public function setVainqueur($vainqueur)
    {
        $this->vainqueur = $vainqueur;
    }

    /**
     * @return mixed
     */
    public function getTerrainJ1()
    {
        return $this->terrainJ1;
    }

    /**
     * @param mixed $terrainJ1
     */
    public function setTerrainJ1($terrainJ1)
    {
        $this->terrainJ1 = $terrainJ1;
    }

    /**
     * @return mixed
     */
    public function getTerrainJ2()
    {
        return $this->terrainJ2;
    }

    /**
     * @param mixed $terrainJ2
     */
    public function setTerrainJ2($terrainJ2)
    {
        $this->terrainJ2 = $terrainJ2;
    }

}
