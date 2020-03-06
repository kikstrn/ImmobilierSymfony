<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EauChaudeRepository")
 */
class EauChaude
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nomEauChaude;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Logement", mappedBy="eauChaude")
     */
    private $logements;

    public function __construct()
    {
        $this->logements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomEauChaude(): ?string
    {
        return $this->nomEauChaude;
    }

    public function setNomEauChaude(string $nomEauChaude): self
    {
        $this->nomEauChaude = $nomEauChaude;

        return $this;
    }

    /**
     * @return Collection|Logement[]
     */
    public function getLogements(): Collection
    {
        return $this->logements;
    }

    public function addLogement(Logement $logement): self
    {
        if (!$this->logements->contains($logement)) {
            $this->logements[] = $logement;
            $logement->setEauChaude($this);
        }

        return $this;
    }

    public function removeLogement(Logement $logement): self
    {
        if ($this->logements->contains($logement)) {
            $this->logements->removeElement($logement);
            // set the owning side to null (unless already changed)
            if ($logement->getEauChaude() === $this) {
                $logement->setEauChaude(null);
            }
        }

        return $this;
    }
}
