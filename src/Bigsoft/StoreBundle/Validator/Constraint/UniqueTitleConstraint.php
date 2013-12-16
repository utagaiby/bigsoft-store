<?php
namespace Bigsoft\StoreBundle\Validator\Constraint;

use Symfony\Component\Validator\Constraint;

class UniqueTitleConstraint extends Constraint {
    public $message = 'Book with title "%title%" already exists';

    public function validatedBy()
    {
        return 'unique_title';
    }
}