<?php
/**
 * Created by PhpStorm.
 * User: infolox
 * Date: 09.05.17
 * Time: 15:16
 */

namespace ix\HangmanBundle\Controller;


use ix\HangmanBundle\Game\GameContext;
use ix\HangmanBundle\Game\GameRunner;
use ix\HangmanBundle\Game\WordList;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\ContainerInterface;


/**
 * @Route("{_locale}/game")
 * @Security("has_role('ROLE_PLAYER')")
 */
class GameController extends Controller
{
    /**
     * @Route(path="/", name="app_game")
     * @Method("GET")
     */
    public function indexAction()
    {
        $game = $this->get(GameRunner::class)->loadGame();

        if ($game->isWon()){
            return $this->redirectToRoute('app_won');
        }
        if ($game->isHanged()){
            return $this->redirectToRoute('app_lost');
        }
        return $this->render(
            '@Hangman/game/index.html.twig',
            [
                'game' => $game
            ]);
    }


    /**
     * @Route(path="/reset", name="reset_game")
     */
    public function resetGame()
    {
        $this->get(GameRunner::class)->resetGame();
        return $this->redirectToRoute('app_game');
    }

    /**
     * @Route(path="/word", name="app_play_word")
     * @Method("Post")
     */
    public function playWordAction(Request $request)
    {
        $word = $request->request->get('word');
        $this->get(GameRunner::class)->playWord($word);

        return $this->redirectToRoute('app_game');
    }

    /**
     * @Route(path="/{letter}", name="app_play_letter", requirements={"letter"="[a-zA-Z]"})
     * @Method("GET")
     */
    public function playLetterAction($letter)
    {
        $this->get(GameRunner::class)->playLetter($letter);

        return $this->redirectToRoute('app_game');
    }

    /**
     * @Route(path="/won", name="app_won")
     */
    public function wonAction()
    {
        $game=$this->get(GameRunner::class)->resetGameOnSuccess();
        return $this->render(
            '@Hangman/game/won.html.twig',
            [
                'game' => $game
            ]);
    }

    /**
     * @Route(path="/lost", name="app_lost")
     */
    public function lostAction()
    {
        $game=$this->get(GameRunner::class)->resetGameOnFailure();
        return $this->render(
            '@Hangman/game/failed.html.twig',
            [
                'game' => $game
            ]);
    }


    private function getGameRunner(){
        $context = new GameContext($this->get('session'));

        $wordList = new WordList();
        $wordList->addWord('airplane');

        return new GameRunner($context, $wordList);
    }
}

