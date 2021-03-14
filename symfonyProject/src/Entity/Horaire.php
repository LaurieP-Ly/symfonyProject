<?php

namespace App\Entity;

use App\Repository\HoraireRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HoraireRepository::class)
 */
class Horaire
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Sport::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $idSport;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Jour;

    /**
     * @ORM\Column(type="string")
     */
    private $Heure;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdSport(): ?Sport
    {
        return $this->idSport;
    }

    public function setIdSport(?Sport $idSport): self
    {
        $this->idSport = $idSport;

        return $this;
    }

    public function getJour(): ?string
    {
        return $this->Jour;
    }

    public function setJour(string $Jour): self
    {
        $this->Jour = $Jour;

        return $this;
    }

    public function getHeure(): ?string
    {
        return $this->Heure;
    }

    public function setHeure(string $Heure): self
    {
        $this->Heure = $Heure;

        return $this;
    }

    public function __toString(){
        return " n° $this->id -- $this->idSport -- $this->Jour -- $this->Heure";
    }

}
