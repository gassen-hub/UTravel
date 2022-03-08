<?php

namespace App\Entity;

use App\Repository\ActiviteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ActiviteRepository::class)
 */
class Activite
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
    private $nom_activite;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type_activite;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prix_activite;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nb_pers;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $date_debut;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $date_fin;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fiche_descriptive;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomActivite(): ?string
    {
        return $this->nom_activite;
    }

    public function setNomActivite(string $nom_activite): self
    {
        $this->nom_activite = $nom_activite;

        return $this;
    }

    public function getTypeActivite(): ?string
    {
        return $this->type_activite;
    }

    public function setTypeActivite(string $type_activite): self
    {
        $this->type_activite = $type_activite;

        return $this;
    }

    public function getPrixActivite(): ?string
    {
        return $this->prix_activite;
    }

    public function setPrixActivite(string $prix_activite): self
    {
        $this->prix_activite = $prix_activite;

        return $this;
    }

    public function getNbPers(): ?string
    {
        return $this->nb_pers;
    }

    public function setNbPers(string $nb_pers): self
    {
        $this->nb_pers = $nb_pers;

        return $this;
    }

    public function getDateDebut(): ?string
    {
        return $this->date_debut;
    }

    public function setDateDebut(string $date_debut): self
    {
        $this->date_debut = $date_debut;

        return $this;
    }

    public function getDateFin(): ?string
    {
        return $this->date_fin;
    }

    public function setDateFin(string $date_fin): self
    {
        $this->date_fin = $date_fin;

        return $this;
    }

    public function getFicheDescriptive(): ?string
    {
        return $this->fiche_descriptive;
    }

    public function setFicheDescriptive(string $fiche_descriptive): self
    {
        $this->fiche_descriptive = $fiche_descriptive;

        return $this;
    }
}
