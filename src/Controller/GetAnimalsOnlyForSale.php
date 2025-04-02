<?php

namespace App\Controller;

use App\Repository\AnimalRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Role\Role;

class GetAnimalsOnlyForSale extends AbstractController
{
    public function __invoke(AnimalRepository $repository, SerializerInterface $serializer): Response
    {  
        $animals = $repository->findBy(['forSale' => true]);
        $jsonContent = $serializer->serialize($animals, 'json', ['groups' => 'animal']);
        return new Response($jsonContent, Response::HTTP_OK, ['Content-Type' => 'application/ld+json']);    
    }  
}