<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
class Utilisateur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\OneToMany(targetEntity: ReservationH::class, mappedBy: 'user')]
    private Collection $reservationHs;

    #[ORM\OneToMany(targetEntity: ReservationM::class, mappedBy: 'user')]
    private Collection $reservationMs;

    public function __construct()
    {
        $this->reservationHs = new ArrayCollection();
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * @return Collection<int, ReservationH>
     */
    public function getReservationHs(): Collection
    {
        return $this->reservationHs;
    }

    public function addReservationH(ReservationH $reservationH): static
    {
        if (!$this->reservationHs->contains($reservationH)) {
            $this->reservationHs->add($reservationH);
            $reservationH->setUser($this);
        }

        return $this;
    }

    public function removeReservationH(ReservationH $reservationH): static
    {
        if ($this->reservationHs->removeElement($reservationH)) {
            // set the owning side to null (unless already changed)
            if ($reservationH->getUser() === $this) {
                $reservationH->setUser(null);
            }
        }

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
            $reservationM->setUser($this);
        }

        return $this;
    }

    public function removeReservationM(ReservationM $reservationM): static
    {
        if ($this->reservationMs->removeElement($reservationM)) {
            // set the owning side to null (unless already changed)
            if ($reservationM->getUser() === $this) {
                $reservationM->setUser(null);
            }
        }

        return $this;
    }
}
