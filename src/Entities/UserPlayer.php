<?php

namespace RockPaperScissorsLizardSpock\Entities;

use RockPaperScissorsLizardSpock\Constants\GamePositionEnum;

// An object class representing the user
class UserPlayer extends Player
{

    public function setCurrentHand(): void
    {
        echo "Here is a list of all available moves:" . PHP_EOL;
        $positions = GamePositionEnum::toArray();
        foreach ($positions as $index => $position) {
            echo ($index + 1) . ". " . $position . PHP_EOL;
        }

        $userChoice = readline("Enter the number of your choice: ");
        while (!isset($positions[$userChoice - 1])) {
            echo "Invalid choice. Please try again." . PHP_EOL;
            $userChoice = readline("Enter the number of your choice: ");
        }

        $this->currentHand = $positions[$userChoice - 1];
    }

}
