<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

use App\Entity\Person;
use App\Helpers\Rest;
use App\Services\QueryParams;
use App\Helpers\QueryParams\PersonParams;
use App\Representation\Persons;


class PersonController extends Controller
{
    use Rest;

    /**
     * @Route(
     *     "/persons/{id}",
     *     name="persons_get",
     *     defaults={"_format": "json"},
     *     requirements={
     *         "id": "\d+"
     *     }
     * )
     * @Method({"GET"})
     */
    public function getAction(Person $person)
    {
        return $this->_jsonResponse($person);
    }

     /**
     * @Route(
     *     "/persons",
     *     name="persons_list",
     *     defaults={"_format": "json"}
     * )
     * @Method({"GET"})
     */
    public function listAction(QueryParams $queryParams, Request $request)
    {
        $params = $queryParams->build(PersonParams::class, $request);

        $repository = $this->getDoctrine()->getManager()->getRepository(Person::class);

        $pager = $repository
            ->search(
                $params->getType(),
                $params->getQuery(),
                'asc',
                $params->getLimit(),
                $params->getOffset()
            );

        return $this->_jsonResponse(new Persons($pager));
    }

    /**
     * @Route(
     *     "/persons",
     *     name="persons_create",
     *     defaults={"_format": "json"}
     * )
     * @Method({"POST"})
     */
    public function createAction(Request $request)
    {
        $data = $request->getContent();

        $person = $this->_fromJson($data, Person::class);

        if ($errors = $this->_validate($person)) {
            return $errors;
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($person);
        $em->flush();

        return $this->_jsonResponse(
            $person,
            Response::HTTP_CREATED,
            [
                'Location' => $this->generateUrl(
                    'persons_get',
                    [ 'id' => $person->getId() ],
                    UrlGeneratorInterface::ABSOLUTE_URL
                )
            ]
        );
    }

    /**
     * @Route(
     *     "/persons/{id}",
     *     name="persons_put",
     *     defaults={"_format": "json"},
     *     requirements={
     *         "id": "\d+"
     *     }
     * )
     * @Method({"PUT"})
     */
    public function putAction(Person $person, Request $request)
    {
        // Temporarilly disabled, will be used only in admin
        return new Response('', Response::HTTP_METHOD_NOT_ALLOWED);

        // --------------------------

        $data = $request->getContent();

        $putPerson = $this->_fromJson($data, Person::class);

        if ($errors = $this->_validate($putPerson)) {
            return $errors;
        }

        $person->hydrate($putPerson);

        $em = $this->getDoctrine()->getManager();
        $em->flush();

        return new Response('', Response::HTTP_NO_CONTENT);
    }

     /**
     * @Route(
     *     "/persons/{id}",
     *     name="persons_delete",
     *     defaults={"_format": "json"},
     *     requirements={
     *         "id": "\d+"
     *     }
     * )
     * @Method({"DELETE"})
     */
    public function deleteAction(Person $person)
    {
        // Temporarilly disabled, will be used only in admin
        return new Response('', Response::HTTP_METHOD_NOT_ALLOWED);

        // --------------------------

        $em = $this->getDoctrine()->getManager();
        $em->remove($person);
        $em->flush();

        return new Response('', Response::HTTP_NO_CONTENT);
    }
}
