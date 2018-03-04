<?php

namespace ix\HangmanBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/hello/{name}",
     *     defaults={"name"="Lindau"},
     *     name="hello")
     */
    public function indexAction(Request $request, $name)
    {
        // replace this example code with whatever you need
        return $this->render(
            'default/index.html.twig',
            [
                'name' => $request->attributes->get('name'),
                'name1' => $name
            ]);
        //return new Response("Hi");
    }
}
