<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ObjectifsRepository")
 */
class Objectifs
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
     * @ORM\Column(type="string", length=100)
     */
    private $image;
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
    public function getNom()
    {
        return $this->nom;
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