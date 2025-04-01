<?php

namespace App\Controller;

use App\Repository\AnimalRepository;
use App\Repository\BreedRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GetAnimalsByBreed extends AbstractController
{
    public function __invoke(AnimalRepository $repository, SerializerInterface $serializer, int $id): Response
    {
        try {
            $animals = $repository->findByBreedId($id);
            $jsonContent = $serializer->serialize($animals, 'json', ['groups' => 'animal']);
            return new Response($jsonContent, Response::HTTP_OK, ['Content-Type' => 'application/ld+json']);
        } catch (\Exception $e) {
            return new Response($e->getMessage(), Response::HTTP_NOT_FOUND);
        }

    }
}   