<?php

// First time using Composer like this; kinda fun, tbh
require_once 'vendor/autoload.php';

use RockPaperScissorsLizardSpock\Controllers\Level1Controller;

$controller = new Level1Controller();
$controller->playGame();
