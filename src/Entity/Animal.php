<?php

namespace App\Entity;

use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use Doctrine\DBAL\Types\Types;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Delete;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiFilter;
use App\Repository\AnimalRepository;
use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use App\Controller\GetAnimalsOnlyForSale;
use ApiPlatform\Doctrine\Orm\Filter\BooleanFilter;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: AnimalRepository::class)]
#[ApiResource(
    operations: [
        new GetCollection(),
        new Post(security: 'is_granted("ROLE_ADMIN")'),
        new Get(controller: GetAnimalsOnlyForSale::class),
        new Patch(security: 'is_granted("ROLE_ADMIN")'),
        new Delete(security: 'is_granted("ROLE_ADMIN")'),
    ],
    normalizationContext: ['groups' => ['animal']],
    denormalizationContext: ['groups' => ['animal']],
)]
#[ApiFilter(BooleanFilter::class, properties: ['forSale', 'forSaleSoon'])]

class Animal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups(['animal', 'breed'])]
    #[ORM\Column]
    private ?int $age = null;

    #[Groups(['animal'])]
    #[ORM\ManyToOne(inversedBy: 'animals')]
    private ?Breed $breed = null;

    #[Groups(['animal', 'breed'])]
    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[Groups(['animal', 'breed'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $picture = null;

    #[Groups(['animal', 'breed'])]
    #[ORM\Column]
    private ?int $priceExcludingTax = null;

    #[Groups(['animal', 'breed'])]
    #[ApiProperty(security: 'is_granted("ROLE_ADMIN")')]
    #[ORM\Column]
    private bool $forSale;

    #[Groups(['animal', 'breed'])]
    #[ApiProperty(security: 'is_granted("ROLE_ADMIN")')]
    #[ORM\Column]
    private bool $forSaleSoon;

    #[Groups(['animal'])]
    private ?float $fullPrice = null;

    private const RANK_TAXES = 1.055;

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

    /**
     * Get the value of fullPrice
     */
    public function getFullPrice(): ?float
    {
        return $this->getPriceExcludingTax() * self::RANK_TAXES;
    }
}
