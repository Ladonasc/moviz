<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

use App\Entity\Language;
use App\Helpers\Rest;
use App\Helpers\QueryParams\LanguageParams;
use App\Services\QueryParams;
use App\Representation\Languages;


class LanguageController extends Controller
{
    use Rest;

    /**
     * @Route(
     *     "/languages/{id}",
     *     name="languages_get",
     *     defaults={"_format": "json"},
     *     requirements={
     *         "id": "\d+"
     *     }
     * )
     * @Method({"GET"})
     */
    public function getAction(Language $language)
    {
        return $this->_jsonResponse($language);
    }

     /**
     * @Route(
     *     "/languages",
     *     name="languages_list",
     *     defaults={"_format": "json"}
     * )
     * @Method({"GET"})
     */
    public function listAction(QueryParams $queryParams, Request $request)
    {
        $params = $queryParams->build(LanguageParams::class, $request);

        $repository = $this->getDoctrine()->getManager()->getRepository(Language::class);

        $pager = $repository
            ->search(
                $params->getType(),
                $params->getQuery(),
                'asc',
                $params->getLimit(),
                $params->getOffset()
            );

        return $this->_jsonResponse(new Languages($pager));
    }

    /**
     * @Route(
     *     "/languages",
     *     name="languages_create",
     *     defaults={"_format": "json"}
     * )
     * @Method({"POST"})
     */
    public function createAction(Request $request)
    {
        // Temporarilly disabled, will be used only in admin
        return new Response('', Response::HTTP_METHOD_NOT_ALLOWED);

        $data = $request->getContent();

        $item = $this->_fromJson($data, Language::class);

        if ($errors = $this->_validate($item)) {
            return $errors;
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($item);
        $em->flush();

        return $this->_jsonResponse(
            $item,
            Response::HTTP_CREATED,
            [
                'Location' => $this->generateUrl(
                    'languages_get',
                    [ 'id' => $item->getId() ],
                    UrlGeneratorInterface::ABSOLUTE_URL
                )
            ]
        );
    }

    /**
     * @Route(
     *     "/languages/{id}",
     *     name="languages_put",
     *     defaults={"_format": "json"},
     *     requirements={
     *         "id": "\d+"
     *     }
     * )
     * @Method({"PUT"})
     */
    public function putAction(Language $language, Request $request)
    {
        // Temporarilly disabled, will be used only in admin
        return new Response('', Response::HTTP_METHOD_NOT_ALLOWED);

        // --------------------------

        $data = $request->getContent();

        $putItem = $this->_fromJson($data, Language::class);

        if ($errors = $this->_validate($putItem)) {
            return $errors;
        }

        $language->hydrate($putItem);

        $em = $this->getDoctrine()->getManager();
        $em->flush();

        return new Response('', Response::HTTP_NO_CONTENT);
    }

     /**
     * @Route(
     *     "/languages/{id}",
     *     name="languages_delete",
     *     defaults={"_format": "json"},
     *     requirements={
     *         "id": "\d+"
     *     }
     * )
     * @Method({"DELETE"})
     */
    public function deleteAction(Language $language)
    {
        // Temporarilly disabled, will be used only in admin
        return new Response('', Response::HTTP_METHOD_NOT_ALLOWED);

        // --------------------------

        $em = $this->getDoctrine()->getManager();
        $em->remove($language);
        $em->flush();

        return new Response('', Response::HTTP_NO_CONTENT);
    }
}
