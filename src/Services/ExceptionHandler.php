<?php

namespace App\Services;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use JMS\Serializer\SerializerInterface;

use App\Exception\QueryParamsViolationsException;

class ExceptionHandler
{
    protected $_serializer;

    /**
     * Auto dependency injection of the JMS serializer service
     *
     * @param SerializerInterface $serializer
     */
    public function __construct(SerializerInterface $serializer)
    {
        $this->_serializer = $serializer;
    }

    public function processException(GetResponseForExceptionEvent $event)
    {
        // Specific handler for QueryParamsViolationsException
        // Return a JSON response with the violations list
        if ($event->getException() instanceof QueryParamsViolationsException) {
            $event->setResponse(new JsonResponse(
                $this->_serializer->serialize($event->getException()->getViolations(), 'json'),
                JsonResponse::HTTP_BAD_REQUEST,
                [],
                true /* already Jsonified */
            ));
        }
    }
}
