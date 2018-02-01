<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

use App\Entity\User;
use App\Helpers\Rest;
use App\Helpers\QueryParams\UserParams;
use App\Services\QueryParams;


class UserController extends Controller
{
    use Rest;

    /**
     * @Route(
     *     "/users/{id}",
     *     name="users_get",
     *     defaults={"_format": "json"},
     *     requirements={
     *         "id": "\d+"
     *     }
     * )
     * @Method({"GET"})
     */
    public function getAction(User $user)
    {
    	// @TODO: Allow this only for admin and for the user himself

        return $this->_jsonResponse($user);
    }

     /**
     * @Route(
     *     "/users",
     *     name="users_list",
     *     defaults={"_format": "json"}
     * )
     * @Method({"GET"})
     */
    public function listAction(QueryParams $queryParams, Request $request)
    {
    	// @TODO: Allow this only for admin

        $params = $queryParams->build(UserParams::class, $request);

        $repository = $this->getDoctrine()->getManager()->getRepository(User::class);

        $users = $repository->searchWithStore($params->getEmail());

        return $this->_jsonResponse($users);
    }

    /**
     * @Route(
     *     "/users",
     *     name="users_create",
     *     defaults={"_format": "json"}
     * )
     * @Method({"POST"})
     */
    public function createAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
    	// @TODO: Allow this only for admin
        return new Response('', Response::HTTP_METHOD_NOT_ALLOWED);

        $data = $request->getContent();

        $user = $this->_fromJson($data, User::class
        );
        if ($errors = $this->_validate($user)) {
            return $errors;
        }

        // Encode provided password
        $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
        $user->setPassword($password);

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        return $this->_jsonResponse(
            $user,
            Response::HTTP_CREATED,
            [
                'Location' => $this->generateUrl(
                    'users_get',
                    [ 'id' => $user->getId() ],
                    UrlGeneratorInterface::ABSOLUTE_URL
                )
            ]
        );
    }

    /**
     * @Route(
     *     "/users/{id}",
     *     name="users_put",
     *     defaults={"_format": "json"},
     *     requirements={
     *         "id": "\d+"
     *     }
     * )
     * @Method({"PUT"})
     */
    public function putAction(User $user, Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        // @TODO: Allow this only for admin
        return new Response('', Response::HTTP_METHOD_NOT_ALLOWED);

        // --------------------------

        $data = $request->getContent();

        $putUser = $this->_fromJson($data, User::class);

        if ($errors = $this->_validate($putUser)) {
            return $errors;
        }

        $user->hydrate($putUser);

         // Encode provided password
        $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
        $user->setPassword($password);

        $em = $this->getDoctrine()->getManager();
        $em->flush();

        return new Response('', Response::HTTP_NO_CONTENT);
    }

     /**
     * @Route(
     *     "/users/{id}",
     *     name="users_delete",
     *     defaults={"_format": "json"},
     *     requirements={
     *         "id": "\d+"
     *     }
     * )
     * @Method({"DELETE"})
     */
    public function deleteAction(User $user)
    {
        // @TODO: Allow this only for admin
        return new Response('', Response::HTTP_METHOD_NOT_ALLOWED);

        // --------------------------

        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();

        return new Response('', Response::HTTP_NO_CONTENT);
    }
}
