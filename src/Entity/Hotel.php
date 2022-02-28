<?php

namespace App\Entity;

use App\Repository\HotelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HotelRepository::class)
 */
class Hotel
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
     * @ORM\Column(type="string", length=255)
     */
    private $location;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbrrooms;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbretoiles;

    /**
     * @ORM\Column(type="string", length=400)
     */
    private $caract;

    /**
     * @ORM\OneToMany(targetEntity=Reservation::class, mappedBy="hotelid")
     */
    private $reservations;

    public function __construct()
    {
        $this->reservations = new ArrayCollection();
    }

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

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getNbrrooms(): ?int
    {
        return $this->nbrrooms;
    }

    public function setNbrrooms(int $nbrrooms): self
    {
        $this->nbrrooms = $nbrrooms;

        return $this;
    }

    public function getNbretoiles(): ?int
    {
        return $this->nbretoiles;
    }

    public function setNbretoiles(int $nbretoiles): self
    {
        $this->nbretoiles = $nbretoiles;

        return $this;
    }

    public function getCaract(): ?string
    {
        return $this->caract;
    }

    public function setCaract(string $caract): self
    {
        $this->caract = $caract;

        return $this;
    }

    /**
     * @return Collection<int, Reservation>
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): self
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations[] = $reservation;
            $reservation->setHotelid($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): self
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getHotelid() === $this) {
                $reservation->setHotelid(null);
            }
        }

        return $this;
    }
}
