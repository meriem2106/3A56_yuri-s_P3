<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    
    #[Assert\NotBlank(message: "Le nom ne peut pas être vide")]
    #[Assert\Regex(
        pattern: '/^[a-zA-Z]+$/',
        message: "Le nom ne peut contenir que des lettres de l'alphabet"
    )]
    #[ORM\Column(length: 10)]
    private ?string $nom = null;

    #[Assert\NotBlank(message: "La description ne peut pas être vide")]
    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[Assert\NotBlank(message:"L'origine'est obligatoire")]
    #[Assert\Regex(
        pattern: '/^[a-zA-Z]+$/',
        message: "L'origine ne peut contenir que des lettres de l'alphabet"
    )]
    #[ORM\Column(length: 255)]
    private ?string $origine = null;
  /**
     * @Assert\NotBlank(message="La catégorie est obligatoire")
     * @Assert\Choice(choices={"ART DE LA TABLE", "VÊTEMENTS", "MAISON & DÉCORATION", "BIJOUX & ACCESSOIRES"}, message="La catégorie doit être ART DE LA TABLE, VÊTEMENTS, MAISON & DÉCORATION ou BIJOUX & ACCESSOIRES")
     */
    #[ORM\Column(length: 255)]
    private ?string $categ = null;
    #[Assert\NotBlank(message:"matiere du produit est obligatoire")]
    #[ORM\Column(length: 255)]
    private ?string $matiere = null;
    
    // #[Assert\NotBlank(message:"L'image est obligatoire")]
    
    #[ORM\Column(length: 255)]
    private ?string $image = null;   
        
       

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Formation $formation = null;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getOrigine(): ?string
    {
        return $this->origine;
    }

    public function setOrigine(string $origine): static
    {
        $this->origine = $origine;

        return $this;
    }

    public function getCateg(): ?string
    {
        return $this->categ;
    }

    public function setCateg(string $categ): static
    {
        $this->categ = $categ;

        return $this;
    }

    public function getMatiere(): ?string
    {
        return $this->matiere;
    }

    public function setMatiere(string $matiere): static
    {
        $this->matiere = $matiere;

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

    public function getFormation(): ?Formation
    {
        return $this->formation;
    }

    public function setFormation(?Formation $formation): static
    {
        $this->formation = $formation;

        return $this;
    }
    public function __tostring()
    {
        return (string)$this->getId();

        
    }
}
