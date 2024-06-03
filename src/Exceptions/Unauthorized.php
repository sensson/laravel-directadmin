<?php

namespace Sensson\DirectAdmin\Exceptions;

use Exception;

class Unauthorized extends Exception
{
    public static function create(): self
    {
        return new self('You do not have access to this resource.');
    }
}
