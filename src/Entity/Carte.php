<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CarteRepository")
 */
class Carte
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nom;
    /**
     * @ORM\Column(type="integer")
     */
    private $valeur;
    /**
     * @ORM\Column(type="text")
     */
    private $image;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Objectifs")
     * @ORM\JoinColumn(nullable=true)
     */
    private $objectifs;
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }
    /**
     * @return mixed
     */
    public function getObjectif()
    {
        return $this->objectifs;
    }
    /**
     * @param mixed $objectif
     */
    public function setObjectif($objectifs)
    {
        $this->objectifs = $objectifs;
    }
    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }
    /**
     * @return mixed
     */
    public function getValeur()
    {
        return $this->valeur;
    }
    /**
     * @param mixed $valeur
     */
    public function setValeur($valeur)
    {
        $this->valeur = $valeur;
    }
    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }
    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }
}