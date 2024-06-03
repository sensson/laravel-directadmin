<?php

namespace Sensson\DirectAdmin\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;

class ConnectionFailed extends HttpException
{
    public static function create(string $message): self
    {
        return new self(500, $message);
    }
}
