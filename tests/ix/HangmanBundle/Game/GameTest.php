<?php
/**
 * Created by PhpStorm.
 * User: infolox
 * Date: 29.06.17
 * Time: 16:21
 */
namespace Tests\ix\Hangmanbundle\Game;

use ix\HangmanBundle\Game\Game;
use PHPUnit\Framework\TestCase;

class GameTest extends TestCase
{
    public function testPlayCorrectWord()
    {
        $game = new Game('php');

        $this->assertTrue($game->tryWord('php'));
        $this->assertTrue($game->isWon());
    }

    public function testTryCorrectLetter()
    {
        $game = new Game('php');

        $this->assertTrue($game->tryLetter('p'));
        $this->assertFalse($game->isOver());
        $this->assertTrue($game->isLetterFound('p'));
    }
    public function testTryWrongLetter()
    {
        $game = new Game('php');

        $this->assertFalse($game->tryLetter('j'));
    }
    public function testTryCorrectLetterTwice()
    {
        $game = new Game('php');
        $game->tryLetter('p');

        $this->assertFalse($game->tryLetter('p'));
    }
    public function testTryInvalidLetter()
    {
        $this->expectException(\InvalidArgumentException::class);
        $game = new Game('php');
        $game->tryLetter('3');
    }
    /**
     * @dataProvider provideWords
     */
    public function testPlayWord($wordA, $wordB, $success)
    {
        $game = new Game($wordA);
        $this->assertSame($success, $game->tryWord($wordB));
    }

    public function provideWords()
    {

        return [
            ['php', 'php', true],
            ['java', 'java', true],
            ['net', 'ruby', false]
        ];
    }

}