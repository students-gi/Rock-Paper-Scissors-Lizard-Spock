<?php

namespace RockPaperScissorsLizardSpock\Services;

use RockPaperScissorsLizardSpock\Entities\Player;
use RockPaperScissorsLizardSpock\Constants\GamePositionEnum;
use RockPaperScissorsLizardSpock\Exceptions\GamePositionException;

// Represents the functionality of a single round, getting player moves and evaluating winners and losers
class GameRoundService
{

    public static function playRound(Player $player1, Player $player2): int
    {
        $player1->setCurrentHand();
        $player2->setCurrentHand();

        $winner = self::evaluateWinner($player1->getCurrentHand(), $player2->getCurrentHand());

        // Adding the winner points
        if ($winner === 1) {
            $player1->addRoundWin();
        }
        elseif ($winner === 2) {
            $player2->addRoundWin();
        }

        return $winner;
    }

    private static function evaluateWinner(string $player1move, string $player2move): int
    {
        if ($player1move === $player2move) {
            return 0; // Tie
        }

        if (array_search($player2move, GamePositionEnum::positionsItCanBeat($player1move)) !== false) {
            // Player 1 wins
            return 1;
        }

        if (array_search($player1move, GamePositionEnum::positionsItCanBeat($player2move)) !== false) {
            // Player 2 wins
            return 2;
        }

        // If we're here, guessing that a non-GamePositionEnum string value was passed
        throw new GamePositionException('Invalid comparison between positions.');
    }

}
