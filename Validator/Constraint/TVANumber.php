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
        'fr' => 'FR[0-9]{11}',
        'es' => 'ES[0-9]{11}',
        'it' => 'IT[0-9]{11}',
    );

    public function validatedBy()
    {
        return 'validator.tva.number';
    }

}
