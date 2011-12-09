<?php

namespace OS\CompanyReportsBundle\Validator\Constraint;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class TVANumberValidator extends ConstraintValidator
{
    private $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function isValid($tvaNumber, Constraint $constraint)
    {
        if (!preg_match('/' . $constraint->patterns[$this->request->getLocale()] . '/i', $tvaNumber)) {
            $this->setMessage($constraint->message);

            return false;
        }

        return true;
    }
}
