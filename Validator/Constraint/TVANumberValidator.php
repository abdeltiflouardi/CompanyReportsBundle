<?php

namespace OS\CompanyReportsBundle\Validator\Constraint;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class TVANumberValidator extends ConstraintValidator
{

    public function validate($tvaNumber, Constraint $constraint)
    {
        return $this->isValid($tvaNumber, $constraint);
    }

    public function isValid($tvaNumber, Constraint $constraint)
    {
        if (null === $tvaNumber || '' === $tvaNumber) {
            return true;
        }

        $code = strtolower(substr($tvaNumber, 0, 2));

        if (!array_key_exists($code, $constraint->patterns) || !preg_match('/' . $constraint->patterns[$code] . '/i', $tvaNumber)) {
            $this->context->addViolation($constraint->message);

            return false;
        }

        return true;
    }
}
