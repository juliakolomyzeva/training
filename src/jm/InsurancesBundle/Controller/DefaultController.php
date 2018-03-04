<?php

namespace jm\InsurancesBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/default")
    */
    public function indexAction()
    {
        return $this->render('InsurancesBundle:Default:index.html.twig');
    }
}
