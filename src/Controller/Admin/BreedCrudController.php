<?php

namespace App\Controller\Admin;

use App\ApiResource\AnimalType;
use App\ApiResource\CategoryType;
use App\Entity\Animal;
use App\Entity\Breed;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class BreedCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Breed::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            ChoiceField::new('type')->setChoices(AnimalType::cases()),
            ChoiceField::new('category')->setChoices(CategoryType::cases())
        ];
    }
}
