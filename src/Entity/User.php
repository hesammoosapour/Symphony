<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;
    /**
    * @ORM\Column(type="string", length=50, unique=true)
    */
    private $username;
    /**
    * @ORM\Column(type="string")
    */
    private $password;
    /**
    * @ORM\Column(type="string", length=255,unique=true)
    */
    private $email;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getRoles()
    {
        return [
            'ROLE_USER'
        ];
        // TODO: Implement getRoles() method.
    }

    public function getPassword()
    {
        return $this->password;
        // TODO: Implement getPassword() method.
    }

    public function getSalt()
    {
        return null;        // TODO: Implement getSalt() method.
    }

    public function getUsername()
    {
        return $this->username;
        // TODO: Implement getUsername() method.
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }
}
