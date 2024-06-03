<?php

namespace Sensson\DirectAdmin\Exceptions;

use Exception;

class CommandNotFound extends Exception
{
    public static function create(string $command): self
    {
        return new self('Command `'.$command.'` does not exist.');
    }
}
