<?php

namespace App\Entity;

use App\Repository\MaisonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: MaisonRepository::class)]
class Maison
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"Le nom est obligatoire")]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"L\'email est obligatoire")]
    private ?string $email = null;

    #[ORM\Column]
    #[Assert\NotBlank(message:"Le nombre de chambres est obligatoire")]
    private ?int $nbChambres = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"La capacité est obligatoire")]
    private ?string $capacite = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"La localisation est obligatoire")]
    private ?string $localisation = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"La ville est obligatoire")]
    private ?string $ville = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"La disponibilité est obligatoire")]
    private ?string $disponibilite = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message:"La description est obligatoire")]
    private ?string $description = null;

    #[ORM\Column(type:"string", length:255, nullable:true)]

    private ?string $image = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"Le prix est obligatoire")]
    private ?string $prix = null;


    #[ORM\OneToMany(targetEntity: ReservationM::class, mappedBy: 'maison')]
    private Collection $reservationMs;

    public function __construct()
    {
        
        $this->reservationMs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getNbChambres(): ?int
    {
        return $this->nbChambres;
    }

    public function setNbChambres(int $nbChambres): static
    {
        $this->nbChambres = $nbChambres;

        return $this;
    }

    public function getCapacite(): ?string
    {
        return $this->capacite;
    }

    public function setCapacite(string $capacite): static
    {
        $this->capacite = $capacite;

        return $this;
    }

    public function getLocalisation(): ?string
    {
        return $this->localisation;
    }

    public function setLocalisation(string $localisation): static
    {
        $this->localisation = $localisation;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): static
    {
        $this->ville = $ville;

        return $this;
    }

    public function getDisponibilite(): ?string
    {
        return $this->disponibilite;
    }

    public function setDisponibilite(string $disponibilite): static
    {
        $this->disponibilite = $disponibilite;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    

    /**
     * @return Collection<int, ReservationM>
     */
    public function getReservationMs(): Collection
    {
        return $this->reservationMs;
    }

    public function addReservationM(ReservationM $reservationM): static
    {
        if (!$this->reservationMs->contains($reservationM)) {
            $this->reservationMs->add($reservationM);
            $reservationM->setMaison($this);
        }

        return $this;
    }

    public function removeReservationM(ReservationM $reservationM): static
    {
        if ($this->reservationMs->removeElement($reservationM)) {
            // set the owning side to null (unless already changed)
            if ($reservationM->getMaison() === $this) {
                $reservationM->setMaison(null);
            }
        }

        return $this;
    }
}
