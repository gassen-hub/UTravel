<?php

namespace App\Entity;

use App\Repository\EndroitRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert ; 

/**
 * @ORM\Entity(repositoryClass=EndroitRepository::class)
 */
class Endroit
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * * @Assert\Length(
     * min = 5 , 
     * max = 50,
     * minMessage = "Le nom de l'endroit doit composer au moins {{limit}} lettre",
     * maxMessage = "Le nom de l'endroit doit composer au plus {{limit}} lettre"
     * )
     */
    private $nom_endroit;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     * min = 5 , 
     * max = 50,
     * minMessage = "Le nom de l'endroit doit composer au moins {{limit}} lettre",
     * maxMessage = "Le nom de l'endroit doit composer au plus {{limit}} lettre"
     * )
     */
    private $categorie;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $disponibilite;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $horaire;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prix;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomEndroit(): ?string
    {
        return $this->nom_endroit;
    }

    public function setNomEndroit(string $nom_endroit): self
    {
        $this->nom_endroit = $nom_endroit;

        return $this;
    }

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(string $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getDisponibilite(): ?string
    {
        return $this->disponibilite;
    }

    public function setDisponibilite(string $disponibilite): self
    {
        $this->disponibilite = $disponibilite;

        return $this;
    }

    public function getHoraire(): ?string
    {
        return $this->horaire;
    }

    public function setHoraire(string $horaire): self
    {
        $this->horaire = $horaire;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): self
    {
        $this->prix = $prix;

        return $this;
    }
}
