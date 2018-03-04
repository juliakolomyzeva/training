<?php
/**
 * Created by PhpStorm.
 * User: infolox
 * Date: 10.05.17
 * Time: 13:39
 */

namespace ix\HangmanBundle\Contact;


use Symfony\Component\Validator\Constraints as Assert;


class Message
{
    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Email(strict=true)
     */
    public $sender;
    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(min=3, max=64)
     */
    public $subject;
    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(min=8)
     */
    public $message;
}