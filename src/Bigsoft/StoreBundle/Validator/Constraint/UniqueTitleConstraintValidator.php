<?php
namespace Bigsoft\StoreBundle\Validator\Constraint;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class UniqueTitleConstraintValidator extends ConstraintValidator
{
    /**
     * @var Registry;
     */
    private $doctrine;

    public function __construct($doctrine)
    {
        $this->doctrine = $doctrine;
    }
    /**
     * Checks if the passed value is valid.
     *
     * @param mixed $value The value that should be validated
     * @param Constraint $constraint The constraint for the validation
     *
     * @api
     */
    public function validate($value, Constraint $constraint)
    {
        if ($this->doctrine->getManager()->getRepository('BigsoftStoreBundle:Product')->findOneBy(['title' => $value])) {
           $this->context->addViolation($constraint->message, ['%title%' => $value]);
        }
    }
}