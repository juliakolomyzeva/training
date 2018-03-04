<?php
/**
 * Created by PhpStorm.
 * User: infolox
 * Date: 30.06.17
 * Time: 10:38
 */

namespace ix\HangmanBundle\Controller;


use ix\HangmanBundle\Security\RegistrationService;
use ix\HangmanBundle\Security\RegistrationType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends Controller
{
    /**
     * @Route(path="/registration", name="app_registration")
     * @Method({"GET", "POST"})
     */
    public function registerAction(Request $request, RegistrationService $registrationService)
    {

        $form = $this->createForm(RegistrationType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $registrationService->register(
                $form->getData()
            );
            return $this->redirectToRoute('app_game');
        }
        return $this->render(
            '@Hangman/registration/registration.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }

    /**
     * @Route(path="/login", name="app_login")
     */
    public function loginAction(
        Request $request,
        AuthenticationUtils $utils
        )
    {
        return $this->render(
            '@Hangman/security/login.html.twig',
            [
                'last_username' => $utils->getLastUsername(),
                'error' => $utils->getLastAuthenticationError()
            ]
        );
    }

    /**
     * @Route(path="/logout", name="app_logout")
     */
    public function logoutAction(){}

}