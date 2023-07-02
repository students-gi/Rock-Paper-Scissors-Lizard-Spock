<?php

namespace RockPaperScissorsLizardSpock\Entities;

// An abstract object class, representing players of "Rock, Paper, Scissors, Lizard, Spock"
abstract class Player
{
    protected int $winCount;
    protected ?string $currentHand; // Should always be a value from GamePositionEnum

    public function __construct()
    {
        $this->winCount = 0;
        $this->currentHand = null;
    }

    abstract public function setCurrentHand(): void;

    public function addWin(): void
    {
        $this->winCount++;
    }

    public function getWinCount(): int
    {
        return $this->winCount;
    }

    public function getCurrentHand(): string
    {
        return $this->currentHand;
    }

}
