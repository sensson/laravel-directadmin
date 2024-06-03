<?php

namespace Sensson\DirectAdmin\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;

class AuthenticationFailed extends HttpException
{
    public static function create(): self
    {
        return new self(401, 'Unauthorized. Please check the credentials.');
    }
}
