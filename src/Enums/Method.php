<?php

namespace Sensson\DirectAdmin\Enums;

enum Method: string
{
    case GET = 'GET';
    case POST = 'POST';
    case PUT = 'PUT';
    case DELETE = 'DELETE';

    public function verb(): string
    {
        return strtolower($this->value);
    }
}
