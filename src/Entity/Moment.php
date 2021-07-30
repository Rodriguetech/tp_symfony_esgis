<?php

namespace App\Entity;

use App\Repository\MomentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MomentRepository::class)
 */
class Moment
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
    private $jour;

    /**
     * @ORM\OneToMany(targetEntity=Visiter::class, mappedBy="jour")
     */
    private $visiters;

    public function __construct()
    {
        $this->visiters = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJour(): ?string
    {
        return $this->jour;
    }

    public function setJour(string $jour): self
    {
        $this->jour = $jour;

        return $this;
    }

    /**
     * @return Collection|Visiter[]
     */
    public function getVisiters(): Collection
    {
        return $this->visiters;
    }

    public function addVisiter(Visiter $visiter): self
    {
        if (!$this->visiters->contains($visiter)) {
            $this->visiters[] = $visiter;
            $visiter->setJour($this);
        }

        return $this;
    }

    public function removeVisiter(Visiter $visiter): self
    {
        if ($this->visiters->removeElement($visiter)) {
            // set the owning side to null (unless already changed)
            if ($visiter->getJour() === $this) {
                $visiter->setJour(null);
            }
        }

        return $this;
    }
}
