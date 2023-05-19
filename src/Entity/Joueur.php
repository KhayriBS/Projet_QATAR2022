<?php

namespace App\Entity;

use App\Repository\JoueurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JoueurRepository::class)]
class Joueur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\Column(length: 50)]
    private ?string $equipe = null;

    #[ORM\OneToMany(mappedBy: 'joueur', targetEntity: Vote::class)]
    private Collection $vote;

    #[ORM\Column]
    private ?float $moyenneVote = null;

    public function __construct()
    {
        $this->vote = new ArrayCollection();
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

    public function getEquipe(): ?string
    {
        return $this->equipe;
    }

    public function setEquipe(string $equipe): self
    {
        $this->equipe = $equipe;

        return $this;
    }

    /**
     * @return Collection<int, Vote>
     */
    public function getVote(): Collection
    {
        return $this->vote;
    }

    public function addVote(Vote $vote): self
    {
        if (!$this->vote->contains($vote)) {
            $this->vote->add($vote);
            $vote->setJoueur($this);
        }

        return $this;
    }

    public function removeVote(Vote $vote): self
    {
        if ($this->vote->removeElement($vote)) {
            // set the owning side to null (unless already changed)
            if ($vote->getJoueur() === $this) {
                $vote->setJoueur(null);
            }
        }

        return $this;
    }

    public function getMoyenneVote(): ?float
    {
        return $this->moyenneVote;
    }

    public function setMoyenneVote(float $moyenneVote,$id): self
    {
        $this->moyenneVote =$moyenneVote;

        return $this;
    }

    public function __toString()
    {
        return(string)$this->getNom();
    }
}


