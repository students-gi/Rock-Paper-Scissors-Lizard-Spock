<?php

namespace RockPaperScissorsLizardSpock\Constants;

use RockPaperScissorsLizardSpock\Constants\GamePositionEnum;
use RockPaperScissorsLizardSpock\Entities\ComputerPlayer;
use InvalidArgumentException;

// An enum-like array class that contains computer player data
class ComputerPlayerEnum
{
    public const PLAYER_DEFINITIONS = [
        "Dwayne Johnson" => [
            GamePositionEnum::ROCK,
            GamePositionEnum::ROCK,
            GamePositionEnum::ROCK
        ],
        "Hermione Granger" => [
            GamePositionEnum::PAPER,
            GamePositionEnum::PAPER,
            GamePositionEnum::PAPER
        ],
        "Postal dude" => [
            GamePositionEnum::SCISSORS,
            GamePositionEnum::SCISSORS,
            GamePositionEnum::SCISSORS
        ],
        "Lizard" => [
            GamePositionEnum::LIZARD,
            GamePositionEnum::LIZARD,
            GamePositionEnum::LIZARD
        ],
        "Spock" => [
            GamePositionEnum::SPOCK,
            GamePositionEnum::SPOCK,
            GamePositionEnum::SPOCK
        ],
        "Illuminati" => [
            GamePositionEnum::LIZARD,
            GamePositionEnum::PAPER
        ],
        "Ninja" => [
            GamePositionEnum::SCISSORS,
            GamePositionEnum::SPOCK
        ],
        "Newcomer" => [
            GamePositionEnum::ROCK,
            GamePositionEnum::PAPER,
            GamePositionEnum::SCISSORS
        ],
        "Wildcard" => []
    ];

    public static function getPlayerById(int $index): ComputerPlayer
    {
        $nameArray = array_keys(self::PLAYER_DEFINITIONS);

        if (isset($nameArray[$index])) {
            $name = $nameArray[$index];
            return self::getPlayerByName($name);
        }

        throw new InvalidArgumentException("Invalid player index: $index");
    }

    public static function getPlayerByName(string $index): ComputerPlayer
    {
        if (isset(self::PLAYER_DEFINITIONS[$index])) {
            $name = $index;
            $moves = self::PLAYER_DEFINITIONS[$name];
            return new ComputerPlayer($name, ...$moves);
        }

        throw new InvalidArgumentException("Invalid player name: $index");
    }

    public static function getPlayerCount(): int
    {
        return count(self::PLAYER_DEFINITIONS);
    }

    private function __construct()
    {
        // Prevent instantiation of the class
    }

}
