<?php

namespace App\Entity;

use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use Doctrine\DBAL\Types\Types;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Delete;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\AnimalRepository;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;

#[ORM\Entity(repositoryClass: AnimalRepository::class)]
#[ApiResource(
    operations: [
        new GetCollection(),
        new Post(),
        new Get(),
        new Patch(),
        new Delete(),
    ],
    normalizationContext: ['groups' => ['animal:create']],
    denormalizationContext: ['groups' => ['animal:create', 'animal:update', 'animal:read']],
)]class Animal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups(['animal:create', 'animal:update', 'animal:read'])]
    #[ORM\Column]
    private ?int $age = null;

    #[Groups(['animal:create', 'animal:update', 'animal:read'])]
    #[ORM\ManyToOne(inversedBy: 'animals')]
    private ?Breed $breed = null;

    #[Groups(['animal:create', 'animal:update', 'animal:read'])]
    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[Groups(['animal:create', 'animal:update', 'animal:read'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $picture = null;

    #[Groups(['animal:create', 'animal:update', 'animal:read'])]

    #[ORM\Column]
    private ?int $priceExcludingTax = null;

    #[Groups(['animal:create', 'animal:update', 'animal:read'])]

    #[ORM\Column]
    private ?bool $forSale = null;

    #[Groups(['animal:create', 'animal:update', 'animal:read'])]

    #[ORM\Column]
    private ?bool $forSaleSoon = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): static
    {
        $this->age = $age;

        return $this;
    }

    public function getBreed(): ?Breed
    {
        return $this->breed;
    }

    public function setBreed(?Breed $breed): static
    {
        $this->breed = $breed;

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

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): static
    {
        $this->picture = $picture;

        return $this;
    }

    public function getPriceExcludingTax(): ?int
    {
        return $this->priceExcludingTax;
    }

    public function setPriceExcludingTax(int $priceExcludingTax): static
    {
        $this->priceExcludingTax = $priceExcludingTax;

        return $this;
    }

    public function isForSale(): ?bool
    {
        return $this->forSale;
    }

    public function setForSale(bool $forSale): static
    {
        $this->forSale = $forSale;

        return $this;
    }

    public function isForSaleSoon(): ?bool
    {
        return $this->forSaleSoon;
    }

    public function setForSaleSoon(bool $forSaleSoon): static
    {
        $this->forSaleSoon = $forSaleSoon;

        return $this;
    }
}
