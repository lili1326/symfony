<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[UniqueEntity(fields: ['email'], message: 'Cet email est déjà utilisé.')]
#[ORM\Entity(repositoryClass: UserRepository::class)]

class User implements PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Le pseudo est obligatoire.")]
    #[Assert\Length(min: 3, max: 50, minMessage: "Le pseudo doit contenir au moins {{ limit }} caractères.")]
    private ?string $pseudo = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Le prénom est obligatoire.")]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "L'email est obligatoire.")]
    #[Assert\Email(message: "L'email '{{ value }}' n'est pas valide.")]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Le mot de passe est obligatoire.")]
    #[Assert\Length(min: 8, minMessage: "Le mot de passe doit contenir au moins {{ limit }} caractères.")]
    #[Assert\Regex(pattern: "/(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).+/", message: "Le mot de passe doit contenir une majuscule, une minuscule, un chiffre et un caractère spécial.")]
    private ?string $password = null;

    public function getId(): ?int { return $this->id; }
    public function getPseudo(): ?string { return $this->pseudo; }
    public function setPseudo(string $pseudo): static { $this->pseudo = $pseudo; return $this; }
    public function getPrenom(): ?string { return $this->prenom; }
    public function setPrenom(string $prenom): static { $this->prenom = $prenom; return $this; }
    public function getEmail(): ?string { return $this->email; }
    public function setEmail(string $email): static { $this->email = $email; return $this; }
    public function getPassword(): ?string { return $this->password; }
    public function setPassword(string $password): static { $this->password = $password; return $this; }
}