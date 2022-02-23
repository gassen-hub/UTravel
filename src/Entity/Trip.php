<?php

namespace App\Entity;

use App\Repository\TripRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TripRepository::class)
 */
class Trip
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $name;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbSejour;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;


    /**
    * @ORM\ManyToOne(targetEntity=Guide::class, inversedBy="trips")
    */
    private $guide;

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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getNbSejour(): ?int
    {
        return $this->nbSejour;
    }

    public function setNbSejour(int $nbSejour): self
    {
        $this->nbSejour = $nbSejour;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getGuide()
    {
        return $this->guide;
    }

    public function setGuide($guide): self
    {
        $this->guide= $guide;
        return $this;
    }
}
