<?php

namespace OS\CompanyReportsBundle\Validator\Constraint;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class TVANumber extends Constraint
{

    public $message  = 'tva.number.error';
    public $patterns = array(
        'fr' => '^FR[A-Za-z0-9]{2}[0-9]{9}$',
        'es' => '^ES[\w\d]{1}[0-9]{7}[\w\d]{1}$',
        'it' => '^IT[0-9]{11}$',
    );

    public function validatedBy()
    {
        return 'validator.tva.number';
    }

}
