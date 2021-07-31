<?php

namespace App\Entity;

use App\Repository\BibliothequeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BibliothequeRepository::class)
 */
class Bibliotheque
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Musee::class, inversedBy="bibliotheques")
     */
    private $numMus;

    /**
     * @ORM\ManyToOne(targetEntity=Ouvrage::class, inversedBy="bibliotheques")
     */
    private $ISBN;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateAchat;

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

    public function getISBN(): ?Ouvrage
    {
        return $this->ISBN;
    }

    public function setISBN(?Ouvrage $ISBN): self
    {
        $this->ISBN = $ISBN;

        return $this;
    }

    public function getDateAchat(): ?\DateTimeInterface
    {
        return $this->dateAchat;
    }

    public function setDateAchat(\DateTimeInterface $dateAchat): self
    {
        $this->dateAchat = $dateAchat;

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
