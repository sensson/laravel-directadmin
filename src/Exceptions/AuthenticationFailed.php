<?php

namespace Sensson\DirectAdmin\Exceptions;

use Exception;

class AuthenticationFailed extends Exception
{
    public static function create(): self
    {
        return new self('Unauthorized. Please check the credentials.');
    }
}
