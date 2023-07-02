<?php

namespace RockPaperScissorsLizardSpock\Exceptions;

use InvalidArgumentException;
use Throwable;

class GameServiceException extends InvalidArgumentException
{

    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}
