<?php

namespace ix\HangmanBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;

class LanguageController extends Controller
{
    /**
     * @Route(path="/", name="app_index")
     */
    public function indexAction(Request $request)
    {
        $locale = $request->cookies->get('lang');
        if (null == $locale){
            $locale = $request->getPreferredLanguage(['en','de']);
        }

        return $this->redirectToRoute('app_game',
            ['_locale'=>$locale]
        );
    }
    /**
     * @Route(path="/switch/{_locale}", name="app_switch_locale")
     */
    public function switchLocaleAction(Request $request)
    {
        $locale = $request->getLocale();
        $cookie = new Cookie(
            'lang',
            $request->getLocale(),
            new \DateTime('+ 1 year')
        );
        $response = $this->redirectToRoute('app_game',
            ['_locale'=>$locale]
        );

        $response->headers->setCookie($cookie);
        return $response;

    }
}
