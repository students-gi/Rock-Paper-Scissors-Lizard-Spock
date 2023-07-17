<?php

namespace RockPaperScissorsLizardSpock\Services;

use RockPaperScissorsLizardSpock\Entities\Player;
use RockPaperScissorsLizardSpock\Exceptions\GameServiceException;

// Represents the functionality of a complete game, going through the rounds and evaluating the final winner
class GameService
{

    public static function playGame(
        Player $player1,
        Player $player2,
        int $numberOfRounds,
        bool $playFormattedGame = false
    ): int {
        // Validating the round count
        if ($numberOfRounds <= 0) {
            throw new GameServiceException("Number of rounds in a game cannot be less than 1!");
        }

        // Running the rounds
        for ($round = 1; $round <= $numberOfRounds; $round++) {
            if ($playFormattedGame) {
                echo PHP_EOL . "===== Round $round =====" . PHP_EOL;
            }

            // Executing the round
            $winner = GameRoundService::playRound($player1, $player2);

            if ($playFormattedGame) {
                // Printing out the round results
                echo $player1->getPlayerName() . " chose: " . $player1->getCurrentHand() . PHP_EOL;
                echo $player2->getPlayerName() .  " chose: " . $player2->getCurrentHand() . PHP_EOL;
                if ($winner === 0) {
                    echo "This round's a tie!";
                }
                elseif ($winner === 1) {
                    echo $player1->getPlayerName() . " won this round!";
                }
                elseif ($winner === 2) {
                    echo $player2->getPlayerName() . " won this round!";
                }
                echo PHP_EOL;
            }
        }

        // Getting the winner
        $winner = self::evaluateWinner($player1, $player2);
        // Resetting the round wins
        $player1->resetRoundWins();
        $player2->resetRoundWins();

        return $winner;
    }

    private static function evaluateWinner(Player $player1, Player $player2): int
    {
        $winner = -1;

        if ($player1->getRoundWinCount() === $player2->getRoundWinCount()) {
            // The game resulted in a tie
            $winner = 0;
        }
        elseif ($player1->getRoundWinCount() > $player2->getRoundWinCount()) {
            // Player 1 wins
            $winner = 1;
        }
        elseif ($player1->getRoundWinCount() < $player2->getRoundWinCount()) {
            // Player 2 wins
            $winner = 2;
        }

        return $winner;

    }

}
