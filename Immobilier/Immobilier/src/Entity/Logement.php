<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;



/**
 * @ORM\Entity(repositoryClass="App\Repository\LogementRepository")
 */
class Logement
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomLogement;

    /**
     * @ORM\Column(type="integer")
     */
    private $nombrePiece;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $prix;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $surfaceTotale;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeLogement", inversedBy="logements")
     * @ORM\JoinColumn(nullable=false)
     */
    private $typeLogement;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Localisation", inversedBy="logements")
     * @ORM\JoinColumn(nullable=false)
     */
    private $localisation;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Chauffage", inversedBy="logements")
     * @ORM\JoinColumn(nullable=false)
     */
    private $chauffage;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\EauChaude", inversedBy="logements")
     * @ORM\JoinColumn(nullable=false)
     */
    private $eauChaude;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Vente", inversedBy="logements")
     * @ORM\JoinColumn(nullable=false)
     */
    private $vente;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0)
     */
    private $depot;

    /**
     * @ORM\Column(type="text")
     */
    private $proximite;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Media", mappedBy="logement")
     */
    private $media;

    public function __construct()
    {
        $this->media = new ArrayCollection();
    }


    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return int|null
     */
    public function getNombrePiece(): ?int
    {
        return $this->nombrePiece;
    }

    /**
     * @param int $nombrePiece
     * @return $this
     */
    public function setNombrePiece(int $nombrePiece): self
    {
        $this->nombrePiece = $nombrePiece;

        return $this;
    }


    public function getPrix(): ?string
    {
        return $this->prix;
    }

    /**
     * @param string $prix
     * @return $this
     */
    public function setPrix(string $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSurfaceTotale(): ?string
    {
        return $this->surfaceTotale;
    }

    /**
     * @param string $surfaceTotale
     * @return $this
     */
    public function setSurfaceTotale(string $surfaceTotale): self
    {
        $this->surfaceTotale = $surfaceTotale;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return $this
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return TypeLogement|null
     */
    public function getTypeLogement(): ?TypeLogement
    {
        return $this->typeLogement;
    }

    /**
     * @param TypeLogement|null $typeLogement
     * @return $this
     */
    public function setTypeLogement(?TypeLogement $typeLogement): self
    {
        $this->typeLogement = $typeLogement;

        return $this;
    }

    /**
     * @return Localisation|null
     */
    public function getLocalisation(): ?Localisation
    {
        return $this->localisation;
    }

    /**
     * @param Localisation|null $localisation
     * @return $this
     */
    public function setLocalisation(?Localisation $localisation): self
    {
        $this->localisation = $localisation;

        return $this;
    }

    /**
     * @return Chauffage|null
     */
    public function getChauffage(): ?Chauffage
    {
        return $this->chauffage;
    }

    /**
     * @param Chauffage|null $chauffage
     * @return $this
     */
    public function setChauffage(?Chauffage $chauffage): self
    {
        $this->chauffage = $chauffage;

        return $this;
    }

    /**
     * @return EauChaude|null
     */
    public function getEauChaude(): ?EauChaude
    {
        return $this->eauChaude;
    }

    /**
     * @param EauChaude|null $eauChaude
     * @return $this
     */
    public function setEauChaude(?EauChaude $eauChaude): self
    {
        $this->eauChaude = $eauChaude;

        return $this;
    }

    /**
     * @return Vente|null
     */
    public function getVente(): ?Vente
    {
        return $this->vente;
    }

    /**
     * @param Vente|null $vente
     * @return $this
     */
    public function setVente(?Vente $vente): self
    {
        $this->vente = $vente;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDepot(): ?string
    {
        return $this->depot;
    }

    /**
     * @param string $depot
     * @return $this
     */
    public function setDepot(string $depot): self
    {
        $this->depot = $depot;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getProximite(): ?string
    {
        return $this->proximite;
    }

    /**
     * @param string $proximite
     * @return $this
     */
    public function setProximite(string $proximite): self
    {
        $this->proximite = $proximite;

        return $this;
    }

    /**
     * @return Collection|Media[]
     */
    public function getMedia(): Collection
    {
        return $this->media;
    }

    public function addMedium(Media $medium): self
    {
        if (!$this->media->contains($medium)) {
            $this->media[] = $medium;
            $medium->setLogement($this);
        }

        return $this;
    }

    public function removeMedium(Media $medium): self
    {
        if ($this->media->contains($medium)) {
            $this->media->removeElement($medium);
            // set the owning side to null (unless already changed)
            if ($medium->getLogement() === $this) {
                $medium->setLogement(null);
            }
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNomLogement()
    {
        return $this->nomLogement;
    }

    /**
     * @param mixed $nomLogement
     */
    public function setNomLogement($nomLogement): void
    {
        $this->nomLogement = $nomLogement;
    }





}
