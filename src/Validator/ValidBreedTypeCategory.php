<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class ValidBreedTypeCategory extends Constraint
{
    public string $message = 'La catégorie "laitière" est uniquement applicable aux bovins.';

    public function getTargets(): string
    {
        return self::CLASS_CONSTRAINT;
    }

}
