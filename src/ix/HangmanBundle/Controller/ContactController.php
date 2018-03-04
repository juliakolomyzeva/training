<?php

namespace ix\HangmanBundle\Controller;

use ix\HangmanBundle\Contact\ContactMailer;
use ix\HangmanBundle\Contact\Message;
use ix\HangmanBundle\Form\MessageType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends Controller
{
    /**
     * @Route(path="/contact", name="app_contact")
     * @Method({"GET", "POST"})
     */
    public function indexAction(Request $request)
    {

        $form = $this->createForm(MessageType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            //send Email
            $this->get(ContactMailer::class)->send($form->getData());

            //return $this->redirectToRoute('app_index');
        }
        return $this->render(
            '@Hangman/contact/index.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }


 /*   private function getContactMailer(){
        return new ContactMailer(
            $this->get('mailer'),
            $this->get('twig'),
            'jumu@infolox.de'
        );
    }*/
}
