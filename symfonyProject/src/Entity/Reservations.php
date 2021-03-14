<?php

namespace App\Entity;

use App\Repository\ReservationsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReservationsRepository::class)
 */
class Reservations
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\ManyToOne(targetEntity=Horaire::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $idHoraire;

    /**
     * @ORM\ManyToOne(targetEntity=Commandes::class, cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $idCommande;

    public function getId(): ?int
    {
        return $this->id;
    }

    

    public function getIdHoraire(): ?Horaire
    {
        return $this->idHoraire;
    }

    public function setIdHoraire(?Horaire $idHoraire): self
    {
        $this->idHoraire = $idHoraire;

        return $this;
    }

    public function getIdCommande(): ?Commandes
    {
        return $this->idCommande;
    }

    public function setIdCommande(?Commandes $idCommande): self
    {
        $this->idCommande = $idCommande;

        return $this;
    }
}
