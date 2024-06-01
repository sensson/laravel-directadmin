<?php

namespace Sensson\DirectAdmin\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;

class ConnectionFailed extends HttpException
{
    public static function create(string $message): static
    {
        return new static(500, $message);
    }
}
