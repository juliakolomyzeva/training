<?php
/**
 * Created by PhpStorm.
 * User: infolox
 * Date: 10.05.17
 * Time: 15:43
 */

namespace ix\HangmanBundle\Contact;


class ContactMailer
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * @var \Twig_Environment
     */
    private $twig;

    /**
     * @param \Swift_Mailer $mailer
     * @param \Twig_Environment $twig
     * @param string $recipient
     */
    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $twig, $recipient)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
        $this->recipient = $recipient;
    }

    public function send(Message $contactMessage)
    {
        $body = $this->twig->render(
            'contact/email.txt.twig',
            [
                'message' => $contactMessage
            ]
        );
        $mail = \Swift_Message::newInstance()
            ->setTo($this->recipient)
            ->setFrom($contactMessage->sender)
            ->setSubject($contactMessage->subject)
            ->setBody($body);

        $this->mailer->send($mail);
    }
}