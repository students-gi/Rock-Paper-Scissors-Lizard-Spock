<?php

namespace RockPaperScissorsLizardSpock\Controllers;

use RockPaperScissorsLizardSpock\Entities\UserPlayer;
use RockPaperScissorsLizardSpock\Entities\ComputerPlayer;
use RockPaperScissorsLizardSpock\Services\GameRoundService;

class Level1Controller
{

    public function playGame(): void
    {
        // Creating the players
        $userPlayer = new UserPlayer();
        $computerPlayer = new ComputerPlayer();

        // Playing for the 3 rounds
        for ($round = 1; $round <= 3; $round++) {
            echo PHP_EOL . " ===== Round $round ===== " . PHP_EOL;

            // Executing the round
            $winner = GameRoundService::playRound($userPlayer, $computerPlayer);

            // Printing out the round results
            echo "You chose: " . $userPlayer->getCurrentHand() . PHP_EOL;
            echo "Computer chose: " . $computerPlayer->getCurrentHand() . PHP_EOL;
            if ($winner === 1) {
                echo "You win this round!";
            }
            elseif ($winner === 2) {
                echo "Computer wins this round!";
            }
            else {
                echo "It's a tie!";
            }
            echo PHP_EOL;
        }

        echo PHP_EOL . " ===== The game has ended! ===== " . PHP_EOL;

        $userWins = $userPlayer->getRoundWinCount();
        $computerWins = $computerPlayer->getRoundWinCount();

        if ($userWins > $computerWins) {
            echo "Congratulations! You won the game!";
        }
        elseif ($userWins < $computerWins) {
            echo "Sorry! The computer wins this time!";
        }
        else {
            echo "It's a tie! No winner in this game!";
        }
        echo PHP_EOL;
    }

}
