<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DepotsRepository")
 */
class Depots
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $montant;

    /**
     * @ORM\Column(type="date")
     */
    private $dateDepot;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $soldeInitial;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Compt", inversedBy="depots")
     */
    private $compt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="depots")
     */
    private $caissier;

  

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant(float $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getDateDepot(): ?\DateTimeInterface
    {
        return $this->dateDepot;
    }

    public function setDateDepot(\DateTimeInterface $dateDepot): self
    {
        $this->dateDepot = $dateDepot;

        return $this;
    }

    public function getSoldeInitial(): ?float
    {
        return $this->soldeInitial;
    }

    public function setSoldeInitial(?float $soldeInitial): self
    {
        $this->soldeInitial = $soldeInitial;

        return $this;
    }

    public function getCompt(): ?Compt
    {
        return $this->compt;
    }

    public function setCompt(?Compt $compt): self
    {
        $this->compt = $compt;

        return $this;
    }

    public function getCaissier(): ?User
    {
        return $this->caissier;
    }

    public function setCaissier(?User $caissier): self
    {
        $this->caissier = $caissier;

        return $this;
    }

   

  
}
