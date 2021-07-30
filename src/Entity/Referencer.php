<?php

namespace App\Entity;

use App\Repository\ReferencerRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReferencerRepository::class)
 */
class Referencer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Site::class, inversedBy="referencers")
     */
    private $nomSite;

    /**
     * @ORM\Column(type="integer")
     */
    private $numeroPage;

    /**
     * @ORM\ManyToOne(targetEntity=Ouvrage::class, inversedBy="referencers")
     */
    private $ISBN;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomSite(): ?Site
    {
        return $this->nomSite;
    }

    public function setNomSite(?Site $nomSite): self
    {
        $this->nomSite = $nomSite;

        return $this;
    }

    public function getNumeroPage(): ?int
    {
        return $this->numeroPage;
    }

    public function setNumeroPage(int $numeroPage): self
    {
        $this->numeroPage = $numeroPage;

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
}
