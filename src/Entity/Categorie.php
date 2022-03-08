<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategorieRepository::class)
 */
class Categorie
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
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity=Endroit::class, mappedBy="no")
     */
    private $endroit;

    /**
     * @ORM\OneToMany(targetEntity=Endroit::class, mappedBy="categories")
     */
    private $endroits;
    
    public function __toString() {
        return $this->nom;
    }
    public function __construct()
    {
        $this->endroit = new ArrayCollection();
        $this->endroits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection|Endroit[]
     */
    public function getEndroit(): Collection
    {
        return $this->endroit;
    }

    public function addEndroit(Endroit $endroit): self
    {
        if (!$this->endroit->contains($endroit)) {
            $this->endroit[] = $endroit;
           
        }

        return $this;
    }

    public function removeEndroit(Endroit $endroit): self
    {
        if ($this->endroit->removeElement($endroit)) {
            // set the owning side to null (unless already changed)
           
        }

        return $this;
    }

    /**
     * @return Collection|Endroit[]
     */
    public function getEndroits(): Collection
    {
        return $this->endroits;
    }
}
