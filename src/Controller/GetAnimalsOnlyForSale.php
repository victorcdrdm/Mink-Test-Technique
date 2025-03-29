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
        if (!$this->getUser()){
            $animals = $repository->findBy(['forSale' => true]);
        }
       
        if ($this->getUser() && in_array('ROLE_ADMIN', $this->getUser()->getRoles())) {
            $animals = $repository->findAll();
        }

        $jsonContent = $serializer->serialize($animals, 'json', ['groups' => 'animal']);
        return new Response($jsonContent, Response::HTTP_OK, ['Content-Type' => 'application/ld+json']);    
    }  
}
