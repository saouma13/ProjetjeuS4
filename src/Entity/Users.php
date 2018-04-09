<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UsersRepository")
 * @ORM\Table(name="users")
 * @UniqueEntity(fields="email", message="Email déjà pris")
 * @UniqueEntity(fields="username", message="Username déjà pris")
 */
class Users implements UserInterface, \Serializable
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $fullName;

    /**
     * @var string
     *
     * @ORM\Column(type="string", unique=true)
     * @Assert\NotBlank()
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(type="string", unique=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $password;
    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $victoire;
    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $defaite;
    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $bloque;
    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $connecte;
    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $partie_cours;
    /**
     * @var array


    /**
     * @var array
     *
     * @ORM\Column(type="text")
     */
    private $roles = [];

    public function getId(): int
    {
        return $this->id;
    }
    /**
    * @ORM\Column(name="is_active", type="boolean")
    */
    private $isActive;
    public function __construct()
    {
        $this->isActive = true;
        // may not be needed, see section on salt below
        // $this->salt = md5(uniqid('', true));
    }
    /**
     * @return mixed
     */
    public function getIsActive()
    {
        return $this->isActive;
    }
    /**
     * @param mixed $isActive
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
    }
    public function setFullName(string $fullName): void
    {
        $this->fullName = $fullName;
    }

    public function getFullName(): ?string
    {
        return $this->fullName; 
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }
    public function getVictoire()
    {
        $victoire = $this->victoire;
        if (empty($victoire)) {
            $victoire = 0;
        }
        return $this->victoire;
    }
    public function setVictoire($victoire)
    {
        $this->victoire = $victoire;
    }
    public function getDefaite()
    {
        $defaite = $this->defaite;
        if (empty($defaite)) {
            $defaite = 0;
        }
        return $this->defaite;
    }
    public function setDefaite($defaite)
    {
        $this->defaite = $defaite;
    }
    public function getBloque()
    {
        $bloque = $this->bloque;
        if (empty($bloque)) {
            $bloque = 0;
        }
        return $this->bloque;
    }
    public function setBloque($bloque)
    {
        $this->bloque = $bloque;
    }
    /**
     * @return int
     */
    public function getConnecte()
    {
        return $this->connecte;
    }
    /**
     * @param int $connecte
     */
    public function setConnecte($connecte)
    {
        $this->connecte = $connecte;
    }

    /**
     * @return int
     */
    public function getPartieCours(): int
    {
        return $this->partie_cours;
    }

    /**
     * @param int $partie_cours
     */
    public function setPartieCours(int $partie_cours)
    {
        $this->partie_cours = $partie_cours;
    }


    /**
     * Retourne les rôles de l'user
     */
    public function getRoles(): array
    {
        $roles = json_decode($this->roles);

        // Afin d'être sûr qu'un user a toujours au moins 1 rôle
        if (empty($roles)) {
            $roles[] = 'ROLE_USER';
        }

        return array_unique($roles);
    }

    public function setRoles(array $roles): void
    {
        $this->roles =json_encode($roles);
    }

    /**
     * Retour le salt qui a servi à coder le mot de passe
     *
     * {@inheritdoc}
     */
    public function getSalt(): ?string
    {
        // See "Do you need to use a Salt?" at https://symfony.com/doc/current/cookbook/security/entity_provider.html
        // we're using bcrypt in security.yml to encode the password, so
        // the salt value is built-in and you don't have to generate one

        return null;
    }

    /**
     * Removes sensitive data from the user.
     *
     * {@inheritdoc}
     */
    public function eraseCredentials(): void
    {
        // Nous n'avons pas besoin de cette methode car nous n'utilions pas de plainPassword
        // Mais elle est obligatoire car comprise dans l'interface UserInterface
        // $this->plainPassword = null;
    }

    /**
     * {@inheritdoc}
     */
    public function serialize(): string
    {
        return serialize([$this->id, $this->username, $this->password]);
    }

    /**
     * {@inheritdoc}
     */
    public function unserialize($serialized): void
    {
        [ $this->id, $this->username, $this->password] = unserialize($serialized, ['allowed_classes' => false]);
    }
}