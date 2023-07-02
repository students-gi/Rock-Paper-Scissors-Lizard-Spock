<?php

// First time using Composer like this; kinda fun, tbh
require_once 'vendor/autoload.php';

use RockPaperScissorsLizardSpock\Controllers\Level1Controller;
use RockPaperScissorsLizardSpock\Controllers\Level2Controller;

$validLevels = [0, 1, 2];
$pickedLevel = -1;

// Prompt the user to choose a level
echo "Choose a level to play (0 for exit, 1 or 2): ";
$pickedLevel = readline();

while (!in_array($pickedLevel, $validLevels)) {
    echo "Invalid level choice. Please try again: ";
    $pickedLevel = readline();
}

if ($pickedLevel === '0') {
    echo "Exiting the game.";
    exit();
} elseif ($pickedLevel === '1') {
    $controller = new Level1Controller();
} elseif ($pickedLevel === '2') {
    $controller = new Level2Controller();
}

$controller->playGame();
