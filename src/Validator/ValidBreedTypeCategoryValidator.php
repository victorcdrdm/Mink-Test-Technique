<?php

namespace App\Validator;

use App\Entity\Breed;
use App\ApiResource\AnimalType;
use App\ApiResource\CategoryType;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class ValidBreedTypeCategoryValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint): void
    {
        if (!$constraint instanceof ValidBreedTypeCategory) {
            throw new UnexpectedTypeException($constraint, ValidBreedTypeCategory::class);
        }

        if (!$value instanceof Breed) {
            return;
        }

        // Vérifier si la catégorie est "laitière" et le type n'est pas "bovins"
        if ($value->getCategory() === CategoryType::LAITIERE && $value->getType() !== AnimalType::COW) {
            $this->context
                ->buildViolation($constraint->message)
                ->addViolation();
        }
    }

}
