<?php
/**
 * Created by PhpStorm.
 * User: infolox
 * Date: 03.07.17
 * Time: 22:27
 */

namespace jm\LibraryBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class LibraryController extends Controller
{
/**
 * @Route("/library")
 */

    public function indexAction()
    {
        return new Response('My Library');
    }
}