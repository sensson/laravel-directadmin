<?php

namespace Sensson\DirectAdmin\Facades;

use Sensson\DirectAdmin\DirectAdmin as BaseDirectAdmin;
use Illuminate\Support\Facades\Facade;

/**
 * @see BaseDirectAdmin
 *
 * @method static call(string $string)
 */
class DirectAdmin extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return BaseDirectAdmin::class;
    }
}
