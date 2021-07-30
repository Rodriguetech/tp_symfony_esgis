<?php

namespace App\Entity;

use App\Repository\PaysRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PaysRepository::class)
 */
class Pays
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
    private $codePays;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbhabitant;

    /**
     * @ORM\OneToMany(targetEntity=Musee::class, mappedBy="codePays")
     */
    private $musees;

    /**
     * @ORM\OneToMany(targetEntity=Ouvrage::class, mappedBy="codePays")
     */
    private $ouvrages;

    /**
     * @ORM\OneToMany(targetEntity=Site::class, mappedBy="codePays")
     */
    private $sites;

    public function __construct()
    {
        $this->musees = new ArrayCollection();
        $this->ouvrages = new ArrayCollection();
        $this->sites = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodePays(): ?string
    {
        return $this->codePays;
    }

    public function setCodePays(string $codePays): self
    {
        $this->codePays = $codePays;

        return $this;
    }

    public function getNbhabitant(): ?int
    {
        return $this->nbhabitant;
    }

    public function setNbhabitant(int $nbhabitant): self
    {
        $this->nbhabitant = $nbhabitant;

        return $this;
    }

    /**
     * @return Collection|Musee[]
     */
    public function getMusees(): Collection
    {
        return $this->musees;
    }

    public function addMusee(Musee $musee): self
    {
        if (!$this->musees->contains($musee)) {
            $this->musees[] = $musee;
            $musee->setCodePays($this);
        }

        return $this;
    }

    public function removeMusee(Musee $musee): self
    {
        if ($this->musees->removeElement($musee)) {
            // set the owning side to null (unless already changed)
            if ($musee->getCodePays() === $this) {
                $musee->setCodePays(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Ouvrage[]
     */
    public function getOuvrages(): Collection
    {
        return $this->ouvrages;
    }

    public function addOuvrage(Ouvrage $ouvrage): self
    {
        if (!$this->ouvrages->contains($ouvrage)) {
            $this->ouvrages[] = $ouvrage;
            $ouvrage->setCodePays($this);
        }

        return $this;
    }

    public function removeOuvrage(Ouvrage $ouvrage): self
    {
        if ($this->ouvrages->removeElement($ouvrage)) {
            // set the owning side to null (unless already changed)
            if ($ouvrage->getCodePays() === $this) {
                $ouvrage->setCodePays(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Site[]
     */
    public function getSites(): Collection
    {
        return $this->sites;
    }

    public function addSite(Site $site): self
    {
        if (!$this->sites->contains($site)) {
            $this->sites[] = $site;
            $site->setCodePays($this);
        }

        return $this;
    }

    public function removeSite(Site $site): self
    {
        if ($this->sites->removeElement($site)) {
            // set the owning side to null (unless already changed)
            if ($site->getCodePays() === $this) {
                $site->setCodePays(null);
            }
        }

        return $this;
    }
}
