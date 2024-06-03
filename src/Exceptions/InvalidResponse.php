<?php

namespace Sensson\DirectAdmin\Exceptions;

use Exception;

class InvalidResponse extends Exception
{
    public static function create(string $message): self
    {
        return new self($message);
    }
}
