<?php

namespace RockPaperScissorsLizardSpock\Entities;

use RockPaperScissorsLizardSpock\Constants\GamePositionEnum;

// An object class representing a computer
class ComputerPlayer extends Player
{
    // An associative array containing all valid moves as keys and the preference of picking them as values
    private array $movePreferences;

    public function __construct(string $computerPlayerName = "", string ...$preferredMoves)
    {
        parent::__construct($computerPlayerName);

        $defaultProbability = 1;
        $this->initializeMovePreferences($defaultProbability);
        $this->adjustMovePreferences(...$preferredMoves);
    }

    private function initializeMovePreferences(int $defaultProbability): void
    {
        $this->movePreferences = array_fill_keys(GamePositionEnum::toArray(), $defaultProbability);
    }

    private function adjustMovePreferences(string ...$preferredMoves): void
    {
        $totalPreferredMoves = count($preferredMoves);
        $preferredMoveStep = 1;
        $preferredMoveProbability = ($totalPreferredMoves * $preferredMoveStep);

        foreach ($preferredMoves as $move) {
            $this->movePreferences[$move] += $preferredMoveProbability;
            $preferredMoveProbability -= $preferredMoveStep;
        }
    }

    public function setCurrentHand(): void
    {
        $totalProbability = array_sum($this->movePreferences);
        $rand = mt_rand(1, $totalProbability);
        $cumulativeProbability = 0;

        foreach ($this->movePreferences as $move => $probability) {
            $cumulativeProbability += $probability;
            if ($rand <= $cumulativeProbability) {
                $this->currentHand = $move;
                break;
            }
        }
    }

}
