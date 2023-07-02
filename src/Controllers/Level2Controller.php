<?php

namespace RockPaperScissorsLizardSpock\Controllers;

use RockPaperScissorsLizardSpock\Constants\GamePositionEnum;
use RockPaperScissorsLizardSpock\Entities\UserPlayer;
use RockPaperScissorsLizardSpock\Entities\ComputerPlayer;
use RockPaperScissorsLizardSpock\Services\GameService;

class Level2Controller
{
    private static array $computerPlayers;
    private static UserPlayer $userPlayer;

    public function __construct()
    {
        // Creating the players
        self::$userPlayer = new UserPlayer();

        self::$computerPlayers[] =
            new computerPlayer("The Rock", GamePositionEnum::ROCK, GamePositionEnum::ROCK, GamePositionEnum::ROCK);
        self::$computerPlayers[] =
            new computerPlayer("The Illuminati", GamePositionEnum::LIZARD, GamePositionEnum::PAPER);
        self::$computerPlayers[] =
            new computerPlayer("The Wildcard");
    }

    public static function playGame(): void
    {
        // Playing against all the players
        foreach (self::$computerPlayers as $computerPlayer) {
            echo "====================================" . PHP_EOL;
            $gamecard = self::$userPlayer->getPlayerName() . " VS " . $computerPlayer->getPlayerName();
            echo str_pad($gamecard, 36, ' ', STR_PAD_BOTH) . PHP_EOL;
            echo "============== FIGHT! ==============" . PHP_EOL;

            // Executing the game
            $winner = GameService::playGame(self::$userPlayer, $computerPlayer, 3);

            // I'm assuming ties aren't allowed
            while ($winner === 0) {
                echo "It's a tie! We need a tiebreaker!";
                $winner = GameService::playGame(self::$userPlayer, $computerPlayer, 1);
            }

            // Ties have been avoided, we can check what to do now
            if ($winner === 1) {
                echo "Congratulations! You defeated " . $computerPlayer->getPlayerName() . "!";
                self::$userPlayer->addGameWin();
                continue;
            } elseif ($winner === 2) {
                echo "Sorry man, you lost to " . $computerPlayer->getPlayerName() . ".";
                $computerPlayer->addGameWin();
                break;
            }
            echo PHP_EOL;
        }

        echo PHP_EOL . " ===== The game has ended! ===== " . PHP_EOL;

        $userWins = self::$userPlayer->getGameWinCount();

        if ($userWins >= 3) {
            echo "Congratulations! You defeated everybody in the game!";
        } else {
            echo "Game Over man, Game Over!";
        }
        echo PHP_EOL;
    }
}
