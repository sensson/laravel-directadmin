<?php

namespace Sensson\DirectAdmin\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;

class CommandNotFound extends HttpException
{
    public static function create(string $command): static
    {
        return new static(405, 'Command `'.$command.'` does not exist.');
    }
}
