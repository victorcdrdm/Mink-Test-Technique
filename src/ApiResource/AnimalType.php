<?php

declare(strict_types=1);

namespace App\ApiResource;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Operation;
use Symfony\Component\Serializer\Annotation\Groups;
enum AnimalType: string
{
    case COW = 'vache';
    case SHEEP = 'ovin';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
    
    public static function isValid(string $value): bool
    {
        return in_array($value, self::values());
    }
}
