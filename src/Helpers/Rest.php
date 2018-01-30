<?php

namespace App\Helpers;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * This trait should be use only on a subclass of Controller
 */
trait Rest
{
    /**
     * Convert an object to his json string reprensentation
     * @param  mixed $object
     * @return string
     */
    protected function _toJson($object)
    {
        return $this->get('jms_serializer')->serialize($object, 'json');
    }

    /**
     * Convert a json string to an object representation of the given class
     *
     * @param  array $data
     * @param  string $class complete class name (see ::class)
     * @return mixed an instance of given class
     */
    protected function _fromJson($data, $class)
    {
        return $this->get('jms_serializer')->deserialize($data, $class, 'json');
    }

    /**
     * Validate the given entity using validator service.
     *
     * Return false if there is no error detected, otherwise an instance of
     * Response reprensenting the JSON response containing the errors;
     *
     * @param  mixed $entity
     * @return Response|false
     */
    protected function _validate($entity)
    {
        $errors = $this->get('validator')->validate($entity);
        if (count($errors)) {
            return $this->_jsonResponse($errors, Response::HTTP_BAD_REQUEST);
        }

        return false;
    }

    /**
     * Simple helper to ease the use of JsonResponse with an already encoded
     * JSON string.
     *
     * @param  object  $data
     * @param  integer [$status=200]
     * @param  array   [$headers=array()]
     * @return JsonResponse
     */
    protected function _jsonResponse($data, $status = 200, $headers = [])
    {
        return new JsonResponse(
            $this->_toJson($data),
            $status,
            $headers,
            true /* content is already serialized as json */
        );
    }
}
