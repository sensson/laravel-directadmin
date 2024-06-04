<?php

namespace Sensson\DirectAdmin\Facades;

use Illuminate\Support\Facades\Facade;
use Sensson\DirectAdmin\DirectAdmin as BaseDirectAdmin;

/**
 * @see BaseDirectAdmin
 *
 * @method static call(string $string, array $params = [])
 * @method static get(string $string, array $params = [])
 * @method static post(string $string, array $params = [])
 * @method static debug()
 */
class DirectAdmin extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return BaseDirectAdmin::class;
    }
}
