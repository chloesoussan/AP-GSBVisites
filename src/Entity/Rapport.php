<?php

namespace App\Entity;

use App\Repository\RapportRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RapportRepository::class)
 */
class Rapport
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="string")
     */
    private $id;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $motif;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $bilan;

    /**
     * @ORM\ManyToOne(targetEntity=Medecin::class, inversedBy="rapports")
     * @ORM\JoinColumn(nullable=false)
     */
    private $medecin;

    /**
     * @ORM\OneToMany(targetEntity=Offrir::class, mappedBy="rapport", orphanRemoval=true)
     */
    private $offrirs;

    /**
     * @ORM\ManyToOne(targetEntity=Visiteur::class, inversedBy="rapports")
     * @ORM\JoinColumn(nullable=false)
     */
    private $visiteur;

    public function __construct()
    {
        $this->offrirs = new ArrayCollection();
    }



    public function getId(): ?string
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getMotif(): ?string
    {
        return $this->motif;
    }

    public function setMotif(?string $motif): self
    {
        $this->motif = $motif;

        return $this;
    }

    public function getBilan(): ?string
    {
        return $this->bilan;
    }

    public function setBilan(?string $bilan): self
    {
        $this->bilan = $bilan;

        return $this;
    }

    public function getMedecin(): ?Medecin
    {
        return $this->medecin;
    }

    public function setMedecin(?Medecin $medecin): self
    {
        $this->medecin = $medecin;

        return $this;
    }

    /**
     * @return Collection|Offrir[]
     */
    public function getOffrirs(): Collection
    {
        return $this->offrirs;
    }

    public function addOffrir(Offrir $offrir): self
    {
        if (!$this->offrirs->contains($offrir)) {
            $this->offrirs[] = $offrir;
            $offrir->setOffrirs($this);
        }

        return $this;
    }

    public function removeOffrir(Offrir $offrir): self
    {
        if ($this->offrirs->removeElement($offrir)) {
            // set the owning side to null (unless already changed)
            if ($offrir->getOffrirs() === $this) {
                $offrir->setOffrirs(null);
            }
        }

        return $this;
    }

    public function getVisiteur(): ?Visiteur
    {
        return $this->visiteur;
    }

    public function setVisiteur(?Visiteur $visiteur): self
    {
        $this->visiteur = $visiteur;

        return $this;
    }


}
