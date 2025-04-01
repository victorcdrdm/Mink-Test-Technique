<?php

namespace App\Repository;

use App\Entity\Animal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Animal>
 */
class AnimalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Animal::class);
    }

    public function findByBreedId(int $id): array
    {
        return $this->createQueryBuilder('a')
            ->join('a.breed', 'b')
            ->where('b.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByBreedType(string $type): array
    {
        return $this->createQueryBuilder('a')
            ->join('a.breed', 'b')
            ->where('b.type = :type')
            ->setParameter('type', $type)  
            ->getQuery()
            ->getResult()
        ;
    }
}
