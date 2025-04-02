<?php

namespace App\Controller\Admin;

use App\ApiResource\AnimalType;
use App\ApiResource\CategoryType;
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
            ChoiceField::new('type')->setChoices(
                [
                    AnimalType::COW->value => AnimalType::COW->name,
                    AnimalType::SHEEP->value => AnimalType::SHEEP->name
                ]
            ),
            ChoiceField::new('category')->setChoices(
                [
                    CategoryType::VIANDE->value => CategoryType::VIANDE->name,
                    CategoryType::LAITIERE->value => CategoryType::LAITIERE->name,
                ]
            )
        ];
    }
}
