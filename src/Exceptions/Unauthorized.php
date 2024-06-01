<?php

namespace Sensson\DirectAdmin\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;

class Unauthorized extends HttpException
{
    public static function create(): static
    {
        return new static(403, 'You do not have access to this resource.');
    }
}