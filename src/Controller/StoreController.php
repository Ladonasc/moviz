<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

use App\Entity\Store;
use App\Helpers\Rest;

class StoreController extends Controller
{
    use Rest;

    /**
     * @Route(
     *     "/stores/{id}",
     *     name="cstores_get",
     *     defaults={"_format": "json"},
     *     requirements={
     *         "id": "\d+"
     *     }
     * )
     * @Method({"GET"})
     */
    public function getAction(Store $store)
    {

        return $this->_jsonResponse($store);
    }

     /**
     * @Route(
     *     "/stores",
     *     name="stores_list",
     *     defaults={"_format": "json"}
     * )
     * @Method({"GET"})
     */
    public function listAction(Request $request)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository(Store::class);

        $stores = $repository->findWithUser();

        return $this->_jsonResponse($stores);
    }

    /**
     * @Route(
     *     "/stores",
     *     name="stores_create",
     *     defaults={"_format": "json"}
     * )
     * @Method({"POST"})
     */
    public function createAction(Request $request)
    {
        // Temporarilly disabled, will be used only in admin (maybe ?)
        return new Response('', Response::HTTP_METHOD_NOT_ALLOWED);

        $data = $request->getContent();

        $store = $this->_fromJson($data, Store::class);

        if ($errors = $this->_validate($store)) {
            return $errors;
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($store);
        $em->flush();

        return $this->_jsonResponse(
            $store,
            Response::HTTP_CREATED,
            [
                'Location' => $this->generateUrl(
                    'stores_get',
                    [ 'id' => $store->getId() ],
                    UrlGeneratorInterface::ABSOLUTE_URL
                )
            ]
        );
    }

    /**
     * @Route(
     *     "/stores/{id}",
     *     name="stores_put",
     *     defaults={"_format": "json"},
     *     requirements={
     *         "id": "\d+"
     *     }
     * )
     * @Method({"PUT"})
     */
    public function putAction(Store $store, Request $request)
    {
        // Temporarilly disabled, will be used only in admin (maybe ?)
        // Or maybe the user's store also ?
        return new Response('', Response::HTTP_METHOD_NOT_ALLOWED);

        // --------------------------

        $data = $request->getContent();

        $putStore = $this->_fromJson($data, Store::class);

        if ($errors = $this->_validate($putStore)) {
            return $errors;
        }

        $store->hydrate($putStore);

        $em = $this->getDoctrine()->getManager();
        $em->flush();

        return new Response('', Response::HTTP_NO_CONTENT);
    }

     /**
     * @Route(
     *     "/stores/{id}",
     *     name="stores_delete",
     *     defaults={"_format": "json"},
     *     requirements={
     *         "id": "\d+"
     *     }
     * )
     * @Method({"DELETE"})
     */
    public function deleteAction(Store $store)
    {
         // Temporarilly disabled, will be used only in admin (maybe ?)
        // Or maybe the user's store also ?
        return new Response('', Response::HTTP_METHOD_NOT_ALLOWED);

        // --------------------------

        $em = $this->getDoctrine()->getManager();
        $em->remove($store);
        $em->flush();

        return new Response('', Response::HTTP_NO_CONTENT);
    }
}
