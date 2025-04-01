<?php

namespace App\Controller;

use App\ApiResource\AnimalType;
use App\Repository\AnimalRepository;
use App\Repository\BreedRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GetAnimalsByType extends AbstractController
{
    public function __invoke(AnimalRepository $repository, SerializerInterface $serializer, string $value): Response
    {      
        try { 
            if(!AnimalType::isValid($value)) {
                return new Response('Breed type is not valide', Response::HTTP_UNPROCESSABLE_ENTITY);
            };

            $animals = $repository->findByBreedType($value);
            $jsonContent = $serializer->serialize($animals, 'json', ['groups' => 'animal']);
            return new Response($jsonContent, Response::HTTP_OK, ['Content-Type' => 'application/ld+json']);
        } catch (\Exception $e) {
            return new Response($e->getMessage(), Response::HTTP_NOT_FOUND);
        }
    }
}
