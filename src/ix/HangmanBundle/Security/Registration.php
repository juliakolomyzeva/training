<?php
/**
 * Created by PhpStorm.
 * User: infolox
 * Date: 30.06.17
 * Time: 10:33
 */

namespace ix\HangmanBundle\Security;

use Symfony\Component\Validator\Constraints as Assert;
class Registration
{
    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    public $email;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(min=8)
     */
    public $rawPassword;

    /**
     * @var \DateTime
     */
    public $birthday;

    /**
     * @Assert\IsTrue()
     */
    public function isPasswordValide()
    {
        return false === stripos($this->rawPassword, $this->email);
    }

}