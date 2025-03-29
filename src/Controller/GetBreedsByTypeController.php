<?php

namespace App\Controller;

use App\Entity\Breed;
use App\ApiResource\AnimalType;
use App\Repository\BreedRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class GetBreedsByTypeController extends AbstractController
{
    public function __invoke(string $type, BreedRepository $repository, SerializerInterface $serializer): Response
    {
        if (!AnimalType::isValid($type)) {
            throw new BadRequestHttpException(sprintf(
                'Le type "%s" n\'est pas valide. Les types valides sont: %s',
                $type,
                implode(', ', AnimalType::values())
            ));
        }

        $breeds = $repository->findBy(['type' => $type]);
        $jsonContent = $serializer->serialize($breeds, 'json', ['groups' => 'breed']);
        return new Response($jsonContent, Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }
}
