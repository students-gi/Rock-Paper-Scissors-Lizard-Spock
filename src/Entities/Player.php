<?php

namespace RockPaperScissorsLizardSpock\Entities;

// An abstract object class, representing players of "Rock, Paper, Scissors, Lizard, Spock"
abstract class Player
{
    protected int $gameWinCount;
    protected int $roundWinCount;
    protected ?string $currentHand; // Should always be a value from GamePositionEnum
    // The Name of player, required by level 2
    private string $playerName;

    public function __construct(string $playerName)
    {
        $this->gameWinCount = 0;
        $this->roundWinCount = 0;
        $this->currentHand = null;
        $this->playerName = $playerName;
    }

    abstract public function setCurrentHand(): void;

    public function addGameWin(): void
    {
        $this->gameWinCount++;
    }

    public function addRoundWin(): void
    {
        $this->roundWinCount++;
    }

    public function resetRoundWins(): void {
        $this->roundWinCount = 0;
    }

    public function getGameWinCount(): int
    {
        return $this->gameWinCount;
    }

    public function getRoundWinCount(): int
    {
        return $this->roundWinCount;
    }

    public function getCurrentHand(): string
    {
        return $this->currentHand;
    }

    public function getPlayerName(): string {
        return $this->playerName;
    }

}
