<?php

namespace RockPaperScissorsLizardSpock\Controllers;

use RockPaperScissorsLizardSpock\Constants\ComputerPlayerEnum;
use RockPaperScissorsLizardSpock\Entities\Player;
use RockPaperScissorsLizardSpock\Entities\UserPlayer;
use RockPaperScissorsLizardSpock\Entities\ComputerPlayer;
use RockPaperScissorsLizardSpock\Services\GameService;

class Level3Controller
{
    public static function playGame(): void
    {
        // Setting up the player choices
        $npcCount = readline("Enter the number of opponents to play against (1-9): ");
        while ($npcCount < 1 || $npcCount > 9) {
            echo "Your value is out of bounds. Please try again." . PHP_EOL;
            $npcCount = readline("Enter the number of opponents to play against (1-9): ");
        }

        $roundCount = readline("Enter the number of rounds each game should take (1-5): ");
        while ($roundCount < 1 || $roundCount > 5) {
            echo "Your value is out of bounds. Please try again." . PHP_EOL;
            $roundCount = readline("Enter the number of rounds each game should take (1-5): ");
        }

        // Creating a randomized array of NPCs
        $gamePlayerArray = self::getRandomComputerPlayerList($npcCount);
        // Adding the user to the player base as well
        $gamePlayerArray[] = new UserPlayer();

        // Playing all the games between everyone
        self::opponentPairing($gamePlayerArray, $roundCount);

        // Sorting and printing the winners
        self::scoreboard($gamePlayerArray);

        // Printing out the winner
        echo PHP_EOL . "The winner this time around is " . $gamePlayerArray[0]->getPlayerName() . "!" . PHP_EOL;
    }

    private static function scoreboard(array $gamePlayerArray): void
    {
        // Sorting the players
        usort($gamePlayerArray, function (Player $player1, Player $player2) {
            $returnVal = $player2->getGameWinCount() - $player1->getGameWinCount();
            if ($returnVal == 0) {
                if ($player1 instanceof UserPlayer) {
                    return 1;
                }
                if ($player2 instanceof UserPlayer) {
                    return -1;
                }
            }

            return $returnVal;
        });

        // Printing the scoreboard
        echo PHP_EOL . str_pad("= Final Results =", 30, '=', STR_PAD_BOTH) . PHP_EOL;
        $previousWins = 50;
        $previousPlace = 0;
        foreach ($gamePlayerArray as $index => $player) {
            if ($previousWins > $player->getGameWinCount()) {
                $previousWins = $player->getGameWinCount();
                $previousPlace++;
            }
            echo str_pad(($previousPlace) . '.', 3, ' ', STR_PAD_LEFT) . "| "
                . str_pad($player->getPlayerName(), 20) . "| "
                . $previousWins . PHP_EOL;
        }
    }

    private static function opponentPairing(array &$allPlayers, $roundCount): void
    {
        $playerCount = count($allPlayers);
        for ($i = 0; $i < $playerCount; $i++) {
            $player1 = $allPlayers[$i];
            for ($j = $i + 1; $j < $playerCount; $j++) {
                $player2 = $allPlayers[$j];

                // Announcing the game
                $gameAnnouncement = ' ' . $player1->getPlayerName() . " VS " . $player2->getPlayerName() . ' ';
                $gameAnnouncement = str_pad($gameAnnouncement, 50, "=", STR_PAD_BOTH);
                echo PHP_EOL . $gameAnnouncement . PHP_EOL;

                // Playing it out
                if ($player1 instanceof UserPlayer || $player2 instanceof UserPlayer) {
                    $winner = GameService::playGame($player1, $player2, $roundCount, true);
                }
                else {
                    $winner = GameService::playGame($player1, $player2, $roundCount, false);
                }

                // Announcing the game's winner
                if ($winner === 0) {
                    // I'm going to ignore Ties this time around; no need to keep playing through a game to quit (IMO)
                    $gameAnnouncement = "It's a draw!";
                }
                elseif ($winner === 1) {
                    $gameAnnouncement = $player1->getPlayerName() . " defeated " . $player2->getPlayerName() . "!";
                    $player1->addGameWin();
                }
                elseif ($winner === 2) {
                    $gameAnnouncement = $player2->getPlayerName() . " defeated " . $player1->getPlayerName() . "!";
                    $player2->addGameWin();
                }
                $gameAnnouncement = str_pad($gameAnnouncement, 30, " ", STR_PAD_BOTH);
                echo PHP_EOL . $gameAnnouncement . PHP_EOL;
            }
        }
    }

    private static function getRandomComputerPlayerList(int $npcCount): array
    {
        $npcArray = [];
        for ($i = 0; $i < $npcCount; $i++) {
            $player = self::getRandomComputerPlayer();

            // A weak way to actually diferrentiate folk, with a high likelihood of many being called
            // Senior Senior Senior,
            // but this solution is the best I currently have in my mind
            while (in_array($player, $npcArray)) {
                $player->setPlayerName($player->getPlayerName() . " Senior");
            }

            $npcArray[] = $player;
        }

        return $npcArray;
    }


    private static function getRandomComputerPlayer(): ComputerPlayer
    {
        $playerId = mt_rand(1, ComputerPlayerEnum::getPlayerCount()) - 1;
        return ComputerPlayerEnum::getPlayerById($playerId);
    }
}
