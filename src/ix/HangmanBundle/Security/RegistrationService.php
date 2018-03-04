<?php
/**
 * Created by PhpStorm.
 * User: infolox
 * Date: 30.06.17
 * Time: 10:58
 */

namespace ix\HangmanBundle\Security;


use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use ix\HangmanBundle\Entity\Player;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationService
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    /**
     * @var EntityManager
     */
    private $entityManager;


    public function __construct(UserPasswordEncoderInterface $encoder, EntityManager $objectManager)
    {

        $this->encoder = $encoder;
        $this->entityManager = $objectManager;
    }

    public function register(Registration $registration)
    {
        $player = new Player();

        $password = $this->encoder->encodePassword(
            $player,
            $registration->rawPassword
        );
        $player->setPassword($password);
        $player->setEmail($registration->email);
        $player->setBirthday($registration->birthday);


        $this->entityManager->persist($player);
        $this->entityManager->flush();
    }
}