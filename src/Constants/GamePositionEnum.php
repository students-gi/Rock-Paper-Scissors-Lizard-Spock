<?php

namespace RockPaperScissorsLizardSpock\Constants;

use ReflectionClass;
use ReflectionClassConstant;

// An enum-like class that contains the valid shapes and their relationships
class GamePositionEnum
{
    public const ROCK = 'rock';
    public const PAPER = 'paper';
    public const SCISSORS = 'scissors';
    public const LIZARD = 'lizard';
    public const SPOCK = 'spock';

    private static $positions = [
        self::ROCK => ['beats' => [self::SCISSORS, self::LIZARD]],
        self::PAPER => ['beats' => [self::ROCK, self::SPOCK]],
        self::SCISSORS => ['beats' => [self::PAPER, self::LIZARD]],
        self::LIZARD => ['beats' => [self::SPOCK, self::PAPER]],
        self::SPOCK => ['beats' => [self::SCISSORS, self::ROCK]],
    ];

    // Returns what positions the passed value can beat
    public static function positionsItCanBeat(string $position): array
    {
        return self::$positions[$position]['beats'];
    }

    public static function toArray(): array
    {
        $reflectionClass = new ReflectionClass(self::class);
        $constants = $reflectionClass->getConstants(ReflectionClassConstant::IS_PUBLIC);

        $indexedConstants = [];
        $index = 0;
        foreach ($constants as $constant) {
            $indexedConstants[$index++] = $constant;
        }

        return $indexedConstants;
    }

}
