<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

use App\Entity\Category;
use App\Helpers\Rest;
use App\Helpers\QueryParams\CategoryParams;
use App\Services\QueryParams;


class CategoryController extends Controller
{
    use Rest;

    /**
     * @Route(
     *     "/categories/{id}",
     *     name="categories_get",
     *     defaults={"_format": "json"},
     *     requirements={
     *         "id": "\d+"
     *     }
     * )
     * @Method({"GET"})
     *
     * arg is automatically injected thanks to type hinting
     * @see https://symfony.com/doc/current/bundles/SensioFrameworkExtraBundle/annotations/converters.html#usage
     */
    public function getAction(Category $category)
    {

        return $this->_jsonResponse($category);
    }

     /**
     * @Route(
     *     "/categories",
     *     name="categories_list",
     *     defaults={"_format": "json"}
     * )
     * @Method({"GET"})
     */
    public function listAction(QueryParams $queryParams, Request $request)
    {
        $params = $queryParams->build(CategoryParams::class, $request);

        $repository = $this->getDoctrine()->getManager()->getRepository(Category::class);

        $categories = $repository->search($params->getQuery());

        return $this->_jsonResponse($categories);
    }

    /**
     * @Route(
     *     "/categories",
     *     name="categories_create",
     *     defaults={"_format": "json"}
     * )
     * @Method({"POST"})
     */
    public function createAction(Request $request)
    {
        $data = $request->getContent();

        $category = $this->_fromJson($data, Category::class);

        if ($errors = $this->_validate($category)) {
            return $errors;
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($category);
        $em->flush();

        return $this->_jsonResponse(
            $category,
            Response::HTTP_CREATED,
            [
                'Location' => $this->generateUrl(
                    'categories_get',
                    [ 'id' => $category->getId() ],
                    UrlGeneratorInterface::ABSOLUTE_URL
                )
            ]
        );
    }

    /**
     * @Route(
     *     "/categories/{id}",
     *     name="categories_put",
     *     defaults={"_format": "json"},
     *     requirements={
     *         "id": "\d+"
     *     }
     * )
     * @Method({"PUT"})
     *
     * arg is automatically injected thanks to type hinting
     * @see https://symfony.com/doc/current/bundles/SensioFrameworkExtraBundle/annotations/converters.html#usage
     */
    public function putAction(Category $category, Request $request)
    {
        // Just here as a POC, in fact a category will never be updated
        return new Response('', Response::HTTP_METHOD_NOT_ALLOWED);

        // --------------------------

        $data = $request->getContent();

        $putCategory = $this->_fromJson($data, Category::class);

        if ($errors = $this->_validate($putCategory)) {
            return $errors;
        }

        $category->setLabel($putCategory->getLabel());

        $em = $this->getDoctrine()->getManager();
        $em->flush();

        return new Response('', Response::HTTP_NO_CONTENT);
    }

     /**
     * @Route(
     *     "/categories/{id}",
     *     name="categories_delete",
     *     defaults={"_format": "json"},
     *     requirements={
     *         "id": "\d+"
     *     }
     * )
     * @Method({"DELETE"})
     *
     * arg is automatically injected thanks to type hinting
     * @see https://symfony.com/doc/current/bundles/SensioFrameworkExtraBundle/annotations/converters.html#usage
     */
    public function deleteAction(Category $category)
    {
        // Just here as a POC, in fact a category will never be updated
        return new Response('', Response::HTTP_METHOD_NOT_ALLOWED);

        // --------------------------

        $em = $this->getDoctrine()->getManager();
        $em->remove($category);
        $em->flush();

        return new Response('', Response::HTTP_NO_CONTENT);
    }
}
