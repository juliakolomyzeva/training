<?php

/**
 * Created by PhpStorm.
 * User: infolox
 * Date: 30.06.17
 * Time: 08:49
 */
namespace Tests\ix\Hangmanbundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * @covers \ix\Hangmanbundle\Controller\GameController
 */

class GameControllerTest extends WebTestCase
{
    protected $client;

    public function testGamePageLoads()
    {
        $response = $this->client->getResponse();

        $this->assertTrue($response->isSuccessful());
    }

    public function testPlayCorrectWord()
    {
        $form = $this->client->getCrawler()->selectButton('Let me guess...')->form();

        $crawler = $this->client->submit($form, ['word' => 'airplain']);

        $this->assertTrue($this->client->getResponse()->isSuccessful());
        $this->assertContains(
            'Congratulation',
            $crawler->filter('h2')->text()
        );
    }

    public function setUp()
    {
        $client = static::createClient();
        $client->followRedirect(true);
        $client->request('GET', 'en/game/');

    }
}