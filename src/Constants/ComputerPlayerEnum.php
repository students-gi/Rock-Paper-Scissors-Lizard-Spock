<?php

namespace RockPaperScissorsLizardSpock\Constants;

use RockPaperScissorsLizardSpock\Constants\GamePositionEnum;
use RockPaperScissorsLizardSpock\Entities\ComputerPlayer;
use InvalidArgumentException;

// An enum-like array class that contains computer player data
class ComputerPlayerEnum
{
    private static array $playerDefinitions = [
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
        $names = array_keys(self::$playerDefinitions);

        if (isset($names[$index])) {
            $name = $names[$index];
            return self::getPlayerByName($name);
        }

        throw new InvalidArgumentException("Invalid player index: $index");
    }

    public static function getPlayerByName(string $index): ComputerPlayer
    {

        if (isset(self::$playerDefinitions[$index])) {
            $name = $index;
            $moves = self::$playerDefinitions[$name];
            return new ComputerPlayer($name, ...$moves);
        }

        throw new InvalidArgumentException("Invalid player name: $index");
    }

    public static function getPlayerCount(): int
    {
        return count(self::$playerDefinitions);
    }

    private function __construct()
    {
        // Prevent instantiation of the class
    }
}
