<?php
declare(strict_types=1);

namespace App\Entity;

final class Etudiant
{
    private ?int $id;
    private string $nom;
    private string $email;
    private Filiere $filiere;

    public function __construct(?int $id, string $nom, string $email, Filiere $filiere)
    {
        $this->setId($id);
        $this->setNom($nom);
        $this->setEmail($email);
        $this->setFiliere($filiere);
    }

    public function getId(): ?int { return $this->id; }

    public function setId(?int $id): void
    {
        if ($id !== null && $id <= 0) {
            throw new \InvalidArgumentException("Identifiant de l'étudiant non valide.");
        }
        $this->id = $id;
    }

    public function getNom(): string { return $this->nom; }

    public function setNom(string $nom): void
    {
        $nom = trim($nom);
        if ($nom === '') {
            throw new \InvalidArgumentException( "Le nom de l'étudiant ne peut pas être vide.");
        }
        $this->nom = $nom;
    }

    public function getEmail(): string { return $this->email; }

    public function setEmail(string $email): void
    {
        $email = trim($email);
        if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException("Email de l'étudiant non valide.");
        }
        $this->email = $email;
    }

    public function getFiliere(): Filiere { return $this->filiere; }

    public function setFiliere(Filiere $filiere): void
    {
        $this->filiere = $filiere;
    }
}