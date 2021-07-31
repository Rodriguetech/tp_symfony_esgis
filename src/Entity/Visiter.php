<?php

namespace App\Entity;

use App\Repository\VisiterRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VisiterRepository::class)
 */
class Visiter
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Musee::class, inversedBy="visiters")
     */
    private $numMus;

    /**
     * @ORM\ManyToOne(targetEntity=Moment::class, inversedBy="visiters")
     */
    private $jour;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbvisiteurs;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomMus;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumMus(): ?Musee
    {
        return $this->numMus;
    }

    public function setNumMus(?Musee $numMus): self
    {
        $this->numMus = $numMus;

        return $this;
    }

    public function getJour(): ?Moment
    {
        return $this->jour;
    }

    public function setJour(?Moment $jour): self
    {
        $this->jour = $jour;

        return $this;
    }

    public function getNbvisiteurs(): ?int
    {
        return $this->nbvisiteurs;
    }

    public function setNbvisiteurs(int $nbvisiteurs): self
    {
        $this->nbvisiteurs = $nbvisiteurs;

        return $this;
    }

    public function getNomMus(): ?string
    {
        return $this->nomMus;
    }

    public function setNomMus(string $nomMus): self
    {
        $this->nomMus = $nomMus;

        return $this;
    }
}