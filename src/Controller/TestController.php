<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

use App\Entity\User;

class TestController extends Controller
{
    /**
     * @Route("/test", name="test")
     */
    public function testAction()
    {
        $em = $this->getDoctrine()->getManager();

        // $user = new User();
        // $user->setEmail('test@example.com');
        // $user->setPassword('111111');
        // $user->setIsAdmin(false);
        // $em->persist($user);
        // $em->flush();

        // $user = $em->getRepository(User::class)
        //            ->find(1);

        return new Response(print_r($user, true));
    }

    /**
     * @Route("/", name="index")
     */
    public function indexAction() {
        return new Response("<html><head></head><body><h1>Homepage</h1>
            <a href=\"/logout\">Logout</a></body></html>");
    }
}
