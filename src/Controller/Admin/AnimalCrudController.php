<?php

namespace App\Controller\Admin;

use App\Entity\Breed;
use App\Entity\Animal;
use Doctrine\ORM\QueryBuilder;
use Doctrine\DBAL\Types\FloatType;
use Doctrine\ORM\EntityRepository;
use App\Repository\BreedRepository;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class AnimalCrudController extends AbstractCrudController  
{

    private EntityManagerInterface $entityManager;
    
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;

    }

    public static function getEntityFqcn(): string
    {
        return Animal::class;
    }

    public function configureFields(string $pageName): iterable
    {

        return [
            NumberField::new("age"),
            AssociationField::new('breed')->setQueryBuilder(
                fn (QueryBuilder $queryBuilder) => 
                $queryBuilder
                    ->getEntityManager()
                    ->getRepository(Breed::class)
                    ->findAll()
            )->setRequired(true),
            ImageField::new('picture')
                ->setBasePath('images/')
                ->setUploadDir('public/images'),
            NumberField::new('priceExcludingTax'),
            TextEditorField::new('description'),
            BooleanField::new('forSale'),
            BooleanField::new('forSaleSoon')
        ];
    }
    
}
