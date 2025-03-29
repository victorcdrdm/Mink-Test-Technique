<?php

namespace App\ApiResource;

use App\ApiResource\AnimalType;

enum CategoryType : string
{
    case VIANDE = 'viande';
    case LAITIERE = 'laitiere';

    public static function isValidForAnimalType(self $category, AnimalType $type): bool
    {
        if ($category === self::LAITIERE && $type !== AnimalType::COW) {
            return false;
        }
        
        return true;
    }
}
