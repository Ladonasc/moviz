<?php

namespace App\Services;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;

use App\Exception\QueryParamsViolationsException;

class QueryParams
{
    protected $_validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->_validator = $validator;
    }

    public function build($className, Request $request)
    {
        $queryParams = new $className();

        $params = $request->query->all();

        foreach ($params as $key => $value) {
            $methodName = 'set' . ucfirst(strtolower($key));
            if (method_exists($queryParams, $methodName)) {
                $queryParams->$methodName($value);
            }
        }

        $errors = $this->_validator->validate($queryParams);

        if (count($errors)) {
            throw new QueryParamsViolationsException($errors);
        }

        return $queryParams;
    }
}
