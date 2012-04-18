<?php

namespace OS\CompanyReportsBundle\Validator\Constraint;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class TVANumberValidator extends ConstraintValidator
{

    public function isValid($tvaNumber, Constraint $constraint)
    {
        if (null === $tvaNumber || '' === $tvaNumber) {
            return true;
        }        

        $code = substr($tvaNumber, 0, 2);

        if (!in_array($code, $constraint->patterns) || !preg_match('/' . $constraint->patterns[$code] . '/i', $tvaNumber)) {
            $this->setMessage($constraint->message);

            return false;
        }

        return true;
    }
}
