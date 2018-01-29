<?php

namespace App\Exception;

use Symfony\Component\Validator\ConstraintViolationList;

class QueryParamsViolationsException extends \InvalidArgumentException
{
    public function __construct(ConstraintViolationList $violations, $code = 0, \Throwable $previous = null)
    {
        $this->_violations = $violations;

        parent::__construct("Invalid query parameters provided", $code, $previous);
    }

    public function getViolations()
    {
        return $this->_violations;
    }
}
