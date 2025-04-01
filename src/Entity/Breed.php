<?php

namespace App\Entity;

use App\Entity\Animal;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Patch;
use App\ApiResource\AnimalType;
use ApiPlatform\Metadata\Delete;
use Doctrine\ORM\Mapping as ORM;
use App\ApiResource\CategoryType;
use ApiPlatform\Metadata\ApiFilter;
use App\Repository\BreedRepository;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use App\Validator\ValidBreedTypeCategory;
use Doctrine\Common\Collections\Collection;
use App\Controller\GetBreedsByTypeController;
use Doctrine\Common\Collections\ArrayCollection;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(
    operations: [
        new GetCollection(),
        new Post(security: 'is_granted("ROLE_ADMIN")'),
        new Get(),
        new Get(name: 'breeds_type', uriTemplate: 'breeds/type/{type}', controller: GetBreedsByTypeController::class),
        new Patch(security: 'is_granted("ROLE_ADMIN")'),
        new Delete(security: 'is_granted("ROLE_ADMIN")'),
    ],
    normalizationContext: ['groups' => ['breed']],
    denormalizationContext: ['groups' => ['breed']],
)]
#[ApiFilter(SearchFilter::class, properties: ['type' => 'exact'])]    
#[ORM\Entity(repositoryClass: BreedRepository::class)]
#[ValidBreedTypeCategory]
class Breed
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['animal', 'breed'])]
    private ?int $id = null;

    #[Groups(['animal' , 'breed'])]
    #[ORM\Column(length: 36)]
    private ?AnimalType $type = null;

    #[Groups(['animal', 'breed'])]
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[Groups(['animal' , 'breed'])]
    #[ORM\Column(length: 36)]
    private ?CategoryType $category = null;

    /**
     * @var Collection<int, Animal>
     */
    #[Groups( 'breed')]
    #[ORM\OneToMany(targetEntity: Animal::class, mappedBy: 'breed')]
    private Collection $animals;

    public function __construct()
    {
        $this->animals = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?AnimalType
    {
        return $this->type;
    }

    public function setType(?AnimalType $type): static
    {
        $this->type = $type;

        return $this;
    }
     public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Animal>
     */
    public function getAnimals(): Collection
    {
        return $this->animals;
    }

    public function addAnimal(Animal $animal): static
    {
        if (!$this->animals->contains($animal)) {
            $this->animals->add($animal);
            $animal->setBreed($this);
        }

        return $this;
    }

    public function removeAnimal(Animal $animal): static
    {
        if ($this->animals->removeElement($animal)) {
            // set the owning side to null (unless already changed)
            if ($animal->getBreed() === $this) {
                $animal->setBreed(null);
            }
        }

        return $this;
    }

    public function getCategory(): ?CategoryType
    {
        return $this->category;
    }

    public function setCategory(?CategoryType $category): self
    {
        $this->category = $category;

        return $this;
    }
}
