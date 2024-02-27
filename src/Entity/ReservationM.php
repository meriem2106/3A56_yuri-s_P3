<?php

namespace App\Entity;

use App\Repository\ReservationMRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationMRepository::class)]
class ReservationM
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $nbAdultes = null;

    #[ORM\Column]
    private ?int $nbEnfants = null;

    #[ORM\Column(length: 255)]
    private ?string $arrangement = null;

    #[ORM\Column(length: 255)]
    private ?string $repartition = null;

    #[ORM\ManyToOne(inversedBy: 'reservationMs')]
    private ?Maison $maison = null;

    #[ORM\ManyToOne(inversedBy: 'reservationMs')]
    private ?Utilisateur $user = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $datearrivee = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $datedepart = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbAdultes(): ?int
    {
        return $this->nbAdultes;
    }

    public function setNbAdultes(int $nbAdultes): static
    {
        $this->nbAdultes = $nbAdultes;

        return $this;
    }

    public function getNbEnfants(): ?int
    {
        return $this->nbEnfants;
    }

    public function setNbEnfants(int $nbEnfants): static
    {
        $this->nbEnfants = $nbEnfants;

        return $this;
    }

    public function getArrangement(): ?string
    {
        return $this->arrangement;
    }

    public function setArrangement(string $arrangement): static
    {
        $this->arrangement = $arrangement;

        return $this;
    }

    public function getRepartition(): ?string
    {
        return $this->repartition;
    }

    public function setRepartition(string $repartition): static
    {
        $this->repartition = $repartition;

        return $this;
    }

    public function getMaison(): ?Maison
    {
        return $this->maison;
    }

    public function setMaison(?Maison $maison): static
    {
        $this->maison = $maison;

        return $this;
    }

    public function getUser(): ?Utilisateur
    {
        return $this->user;
    }

    public function setUser(?Utilisateur $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getDatearrivee(): ?\DateTimeInterface
    {
        return $this->datearrivee;
    }

    public function setDatearrivee(\DateTimeInterface $datearrivee): static
    {
        $this->datearrivee = $datearrivee;

        return $this;
    }

    public function getDatedepart(): ?\DateTimeInterface
    {
        return $this->datedepart;
    }

    public function setDatedepart(\DateTimeInterface $datedepart): static
    {
        $this->datedepart = $datedepart;

        return $this;
    }
}
