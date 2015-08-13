<?php

namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Constraint;

class SpanishIdValidator extends  ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (!$this->IsValidDniNie($value)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('%string%', $value)
                ->addViolation();

        }
    }


    private function IsValidDniNie($value) {
        if (strlen($value) != 9 ||
            preg_match('/^[XYZ]?([0-9]{7,8})([A-Z])$/i', $value, $matches) !== 1) {
            return false;
        }

        $map = 'TRWAGMYFPDXBNJZSQVHLCKE';

        list(, $number, $letter) = $matches;

        return strtoupper($letter) === $map[((int) $number) % 23];
    }
}