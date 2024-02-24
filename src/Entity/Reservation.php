<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;




#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"Le nombre d\'adultes est obligatoire")]
    private ?string $nbAdultes = null;

    #[ORM\Column]
    #[Assert\NotBlank(message:"Le nombre d\'enfants est obligatoire")]
    private ?int $nbEnfants = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\NotBlank(message:"La date d\'arrivée est obligatoire")]
    #[Assert\GreaterThanOrEqual(propertyPath:"datedepart", message:"La date de départ doit être postérieure  à la date d'arrivée")]
    private ?\DateTimeInterface $datearrivee = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\NotBlank(message:"La date de depart est obligatoire")]
    #[Assert\LessThanOrEqual(propertyPath:"datearrivee")]
    private ?\DateTimeInterface $datedepart = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"L\'arrangement est obligatoire")]
    private ?string $arrangement = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"La repartition est obligatoire")]
    private ?string $repartition = null;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    private ?Maison $maison = null;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    private ?Hotel $hotel = null;

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbAdultes(): ?string
    {
        return $this->nbAdultes;
    }

    public function setNbAdultes(string $nbAdultes): static
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

    public function getHotel(): ?Hotel
    {
        return $this->hotel;
    }

    public function setHotel(?Hotel $hotel): static
    {
        $this->hotel = $hotel;

        return $this;
    }

    

    
}
