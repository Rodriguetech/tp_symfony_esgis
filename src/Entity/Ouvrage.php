<?php

namespace App\Entity;

use App\Repository\OuvrageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OuvrageRepository::class)
 */
class Ouvrage
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
    private $ISBN;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbPage;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\ManyToOne(targetEntity=Pays::class, inversedBy="ouvrages")
     */
    private $codePays;

    /**
     * @ORM\OneToMany(targetEntity=Bibliotheque::class, mappedBy="ISBN")
     */
    private $bibliotheques;

    /**
     * @ORM\OneToMany(targetEntity=Referencer::class, mappedBy="ISBN")
     */
    private $referencers;

    public function __construct()
    {
        $this->bibliotheques = new ArrayCollection();
        $this->referencers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getISBN(): ?string
    {
        return $this->ISBN;
    }

    public function setISBN(string $ISBN): self
    {
        $this->ISBN = $ISBN;

        return $this;
    }

    public function getNbPage(): ?int
    {
        return $this->nbPage;
    }

    public function setNbPage(int $nbPage): self
    {
        $this->nbPage = $nbPage;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getCodePays(): ?Pays
    {
        return $this->codePays;
    }

    public function setCodePays(?Pays $codePays): self
    {
        $this->codePays = $codePays;

        return $this;
    }

    /**
     * @return Collection|Bibliotheque[]
     */
    public function getBibliotheques(): Collection
    {
        return $this->bibliotheques;
    }

    public function addBibliotheque(Bibliotheque $bibliotheque): self
    {
        if (!$this->bibliotheques->contains($bibliotheque)) {
            $this->bibliotheques[] = $bibliotheque;
            $bibliotheque->setISBN($this);
        }

        return $this;
    }

    public function removeBibliotheque(Bibliotheque $bibliotheque): self
    {
        if ($this->bibliotheques->removeElement($bibliotheque)) {
            // set the owning side to null (unless already changed)
            if ($bibliotheque->getISBN() === $this) {
                $bibliotheque->setISBN(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Referencer[]
     */
    public function getReferencers(): Collection
    {
        return $this->referencers;
    }

    public function addReferencer(Referencer $referencer): self
    {
        if (!$this->referencers->contains($referencer)) {
            $this->referencers[] = $referencer;
            $referencer->setISBN($this);
        }

        return $this;
    }

    public function removeReferencer(Referencer $referencer): self
    {
        if ($this->referencers->removeElement($referencer)) {
            // set the owning side to null (unless already changed)
            if ($referencer->getISBN() === $this) {
                $referencer->setISBN(null);
            }
        }

        return $this;
    }
}
