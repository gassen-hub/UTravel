<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass=PostRepository::class)
 */
class Post
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    public function getId(): ?int
    {
        return $this->id;
    }
    /**
     * @ORM\Column(type="string", length=255)
     *  @Assert\NotBlank(message="object is required")

     */

    private $object;



    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="content is required")
     */
    private $content;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank(message="date fin is required")
     */
    private $date;

    /**
     * @ORM\OneToMany(targetEntity=Comments::class, mappedBy="post", orphanRemoval=true)
     */
    private $comments;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $abn;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $jaime;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $jaimepas;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
    }



    public function getObject(): ?string
    {
        return $this->object;
    }

    public function setObject(string $object): self
    {
        $this->object = $object;

        return $this;
    }
    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

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

    /**
     * @return Collection|Comments[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comments $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setPost($this);
        }

        return $this;
    }

    public function removeComment(Comments $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getPost() === $this) {
                $comment->setPost($this);
            }
        }

        return $this;
    }

    public function getAbn(): ?int
    {
        return $this->abn;
    }

    public function setAbn(?int $abn): self
    {
        $this->abn = $abn;

        return $this;
    }
 
    /**
     * Increment upvote_count
     *
     * @return $this
     */
    public function incrUpvote()
    {
      $this->upvote_count++;
      return $this;
    }

    /**
     * Decrement upvote_count
     *
     * @return $this
     */
    public function decrUpvote()
    {
      $this->upvote_count--;
      return $this;
    }

    public function getJaime(): ?int
    {
        return $this->jaime;
    }

    public function setJaime(?int $jaime): self
    {
        $this->jaime = $jaime;

        return $this;
    }

    public function getJaimepas(): ?int
    {
        return $this->jaimepas;
    }

    public function setJaimepas(?int $jaimepas): self
    {
        $this->jaimepas = $jaimepas;

        return $this;
    }

}
