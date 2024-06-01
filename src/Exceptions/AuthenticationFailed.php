<?php

namespace Sensson\DirectAdmin\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;

class AuthenticationFailed extends HttpException
{
    public static function create(): static
    {
        return new static(401, 'Unauthorized. Please check the credentials.');
    }
}
