<?php

namespace Sensson\DirectAdmin\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;

class CommandNotFound extends HttpException
{
    public static function create(string $command): self
    {
        return new self(405, 'Command `'.$command.'` does not exist.');
    }
}
